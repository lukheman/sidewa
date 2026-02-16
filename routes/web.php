<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LandingPage;
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

// Kepala Desa Livewire Components
use App\Livewire\KepalaDesa\Dashboard as KepalaDesaDashboard;
use App\Livewire\KepalaDesa\VerifikasiSurat;

// Public Routes
Route::get('/', LandingPage::class)->name('home');

// Admin Auth Routes
Route::get('/admin/login', Login::class)->name('admin.login');
Route::get('/register', Register::class)->name('register');

// Masyarakat Auth Routes
Route::prefix('masyarakat')->group(function () {
    Route::get('/login', MasyarakatLogin::class)->name('masyarakat.login');
    Route::get('/register', MasyarakatRegister::class)->name('masyarakat.register');

    // Protected Masyarakat Routes
    Route::middleware('auth:masyarakat')->group(function () {
        Route::get('/dashboard', MasyarakatDashboard::class)->name('masyarakat.dashboard');
        Route::get('/profile', MasyarakatProfile::class)->name('masyarakat.profile');
        Route::get('/pengaduan', MasyarakatPengaduan::class)->name('masyarakat.pengaduan');
        Route::get('/pengaduan/create', MasyarakatPengaduanCreate::class)->name('masyarakat.pengaduan.create');
        Route::get('/pengajuan-surat', MasyarakatPengajuanSurat::class)->name('masyarakat.pengajuan-surat');
        Route::get('/pengajuan-surat/create', MasyarakatPengajuanSuratCreate::class)->name('masyarakat.pengajuan-surat.create');
        Route::post('/logout', function () {
            auth()->guard('masyarakat')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('masyarakat.login');
        })->name('masyarakat.logout');
    });
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // User & Masyarakat Management
    Route::get('/users', UserManagement::class)->name('admin.users');
    Route::get('/masyarakat', MasyarakatManagement::class)->name('admin.masyarakat');

    // Master Data
    Route::get('/jenis-surat', JenisSuratManagement::class)->name('admin.jenis-surat');

    // Informasi & Kegiatan
    Route::get('/pengumuman', PengumumanManagement::class)->name('admin.pengumuman');
    Route::get('/kegiatan', KegiatanManagement::class)->name('admin.kegiatan');

    // Layanan Publik
    Route::get('/pengaduan', PengaduanManagement::class)->name('admin.pengaduan');
    Route::get('/pengajuan-surat', PengajuanSuratManagement::class)->name('admin.pengajuan-surat');

    // Profile & Others
    Route::get('/profile', Profile::class)->name('admin.profile');
    Route::get('/components', ComponentDocs::class)->name('admin.components');
    Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');
});

// Pelayanan Routes
Route::prefix('pelayanan')->middleware('auth')->group(function () {
    Route::get('/dashboard', PelayananDashboard::class)->name('pelayanan.dashboard');
    Route::get('/pengajuan-surat', PengajuanSuratMasuk::class)->name('pelayanan.pengajuan-surat');
});

// Kepala Desa Routes
Route::prefix('kepala-desa')->middleware('auth')->group(function () {
    Route::get('/dashboard', KepalaDesaDashboard::class)->name('kepala-desa.dashboard');
    Route::get('/verifikasi-surat', VerifikasiSurat::class)->name('kepala-desa.verifikasi-surat');
    Route::get('/pengaduan', App\Livewire\KepalaDesa\PengaduanIndex::class)->name('kepala-desa.pengaduan');
    Route::get('/pengaduan/print', [App\Http\Controllers\KepalaDesa\PengaduanReportController::class, 'print'])->name('kepala-desa.pengaduan.print');
});
