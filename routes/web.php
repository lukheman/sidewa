<?php

use Illuminate\Support\Facades\Route;
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

// Auth Routes
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

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