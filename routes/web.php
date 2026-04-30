<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LandingPage;
use App\Livewire\PengumumanPage;
use App\Livewire\KegiatanPage;
use App\Livewire\Admin\AparaturManagement;
use App\Livewire\Admin\AnggaranManagement;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Admin\MasyarakatManagement;
use App\Livewire\Admin\JenisSuratManagement;
use App\Livewire\Admin\PengumumanManagement;
use App\Livewire\Admin\KegiatanManagement;
use App\Livewire\Admin\PengaduanManagement;
use App\Livewire\Admin\PengajuanSuratManagement;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\ComponentDocs;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Http\Controllers\Admin\LogoutController;

// Masyarakat Livewire Components
use App\Livewire\Masyarakat\Login as MasyarakatLogin;
use App\Livewire\Masyarakat\Register as MasyarakatRegister;
use App\Livewire\Masyarakat\Dashboard as MasyarakatDashboard;
use App\Livewire\Masyarakat\Profile as MasyarakatProfile;
use App\Livewire\Masyarakat\PengaduanPage as MasyarakatPengaduan;
use App\Livewire\Masyarakat\PengaduanCreate as MasyarakatPengaduanCreate;
use App\Livewire\Masyarakat\PengajuanSuratPage as MasyarakatPengajuanSurat;
use App\Livewire\Masyarakat\PengajuanSuratCreate as MasyarakatPengajuanSuratCreate;

// Pelayanan Livewire Components
use App\Livewire\Pelayanan\Dashboard as PelayananDashboard;
use App\Livewire\Pelayanan\PengajuanSuratMasuk;
use App\Livewire\Pelayanan\LaporanMasyarakat;

// Kepala Desa Livewire Components
use App\Livewire\KepalaDesa\Dashboard as KepalaDesaDashboard;
use App\Livewire\KepalaDesa\VerifikasiSurat;
use App\Livewire\KepalaDesa\LaporanMasyarakat as KepalaDesaLaporanMasyarakat;
use App\Livewire\KepalaDesa\LaporanKegiatan as KepalaDesaLaporanKegiatan;

// Public Routes
Route::get('/', LandingPage::class)->name('home');
Route::get('/pengumuman', PengumumanPage::class)->name('pengumuman');
Route::get('/kegiatan', KegiatanPage::class)->name('kegiatan');
Route::get('/struktur-organisasi', \App\Livewire\StrukturOrganisasiPage::class)->name('struktur-organisasi');
Route::get('/transparansi-anggaran', \App\Livewire\TransparansiAnggaranPage::class)->name('transparansi-anggaran');
Route::get('/verifikasi/{token}', [App\Http\Controllers\VerifikasiSuratController::class, 'verify'])->name('verifikasi.surat');

// Auth Routes (Pelayanan & Kepala Desa)
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// Masyarakat Auth Routes
Route::prefix('masyarakat')->group(function () {
    Route::get('/register', MasyarakatRegister::class)->name('masyarakat.register');

    // Protected Masyarakat Routes
    Route::middleware('auth:masyarakat')->group(function () {
        Route::get('/dashboard', MasyarakatDashboard::class)->name('masyarakat.dashboard');
        Route::get('/profile', MasyarakatProfile::class)->name('masyarakat.profile');
        Route::get('/pengaduan', MasyarakatPengaduan::class)->name('masyarakat.pengaduan');
        Route::get('/pengaduan/create', MasyarakatPengaduanCreate::class)->name('masyarakat.pengaduan.create');
        Route::get('/pengajuan-surat', MasyarakatPengajuanSurat::class)->name('masyarakat.pengajuan-surat');
        Route::get('/pengajuan-surat/create', MasyarakatPengajuanSuratCreate::class)->name('masyarakat.pengajuan-surat.create');
        Route::get('/surat/{id}/cetak', [App\Http\Controllers\SuratPdfController::class, 'cetak'])->name('masyarakat.surat.cetak');
        Route::post('/logout', function () {
            auth()->guard('masyarakat')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login');
        })->name('masyarakat.logout');
    });
});

// Shared route: Cetak Surat (accessible by all authenticated users)
Route::get('/surat/{id}/cetak', [App\Http\Controllers\SuratPdfController::class, 'cetak'])
    ->middleware('auth')
    ->name('surat.cetak');

// Pelayanan Routes (includes all management features previously under admin)
Route::prefix('pelayanan')->middleware('auth')->group(function () {
    Route::get('/dashboard', PelayananDashboard::class)->name('pelayanan.dashboard');

    // Data Master
    Route::get('/users', UserManagement::class)->name('pelayanan.users');
    Route::get('/masyarakat', MasyarakatManagement::class)->name('pelayanan.masyarakat');
    Route::get('/jenis-surat', JenisSuratManagement::class)->name('pelayanan.jenis-surat');

    // Informasi & Kegiatan
    Route::get('/pengumuman', PengumumanManagement::class)->name('pelayanan.pengumuman');
    Route::get('/kegiatan', KegiatanManagement::class)->name('pelayanan.kegiatan');
    Route::get('/aparatur', AparaturManagement::class)->name('pelayanan.aparatur');
    Route::get('/anggaran', AnggaranManagement::class)->name('pelayanan.anggaran');

    // Layanan Publik
    Route::get('/pengaduan', App\Livewire\Pelayanan\PengaduanMasuk::class)->name('pelayanan.pengaduan');
    Route::get('/pengajuan-surat', PengajuanSuratMasuk::class)->name('pelayanan.pengajuan-surat');

    // Laporan
    Route::get('/laporan-masyarakat', LaporanMasyarakat::class)->name('pelayanan.laporan-masyarakat');
    Route::get('/laporan-masyarakat/print', [App\Http\Controllers\LaporanMasyarakatController::class, 'print'])->name('pelayanan.laporan-masyarakat.print');

    // Profile & Others
    Route::get('/profile', Profile::class)->name('pelayanan.profile');
    Route::get('/components', ComponentDocs::class)->name('pelayanan.components');
    Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');
});

// Kepala Desa Routes
Route::prefix('kepala-desa')->middleware('auth')->group(function () {
    Route::get('/dashboard', KepalaDesaDashboard::class)->name('kepala-desa.dashboard');
    Route::get('/verifikasi-surat', VerifikasiSurat::class)->name('kepala-desa.verifikasi-surat');
    Route::get('/pengaduan', App\Livewire\KepalaDesa\PengaduanIndex::class)->name('kepala-desa.pengaduan');
    Route::get('/pengaduan/print', [App\Http\Controllers\KepalaDesa\PengaduanReportController::class, 'print'])->name('kepala-desa.pengaduan.print');
    
    // Laporan
    Route::get('/laporan-masyarakat', KepalaDesaLaporanMasyarakat::class)->name('kepala-desa.laporan-masyarakat');
    Route::get('/laporan-masyarakat/print', [App\Http\Controllers\LaporanMasyarakatController::class, 'print'])->name('kepala-desa.laporan-masyarakat.print');
    
    Route::get('/laporan-kegiatan', KepalaDesaLaporanKegiatan::class)->name('kepala-desa.laporan-kegiatan');
    Route::get('/laporan-kegiatan/print', [App\Http\Controllers\KepalaDesa\LaporanKegiatanController::class, 'print'])->name('kepala-desa.laporan-kegiatan.print');

    Route::get('/profile', Profile::class)->name('kepala-desa.profile');
});
