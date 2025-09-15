<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masyarakat\LoginController;
use App\Http\Controllers\Masyarakat\RegisterController;
use App\Http\Controllers\Masyarakat\PengaduanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Petugas\PetugasAuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Petugas\TanggapanController as PetugasTanggapanController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;


// ==========================
// Halaman landing (umum sebelum login)
// ==========================
Route::get('/', function () {
    return view('landing');
})->name('landing');


// Alias untuk login/register -> redirect ke route masyarakat
Route::get('/login', fn() => redirect()->route('masyarakat.login'))->name('login');
Route::get('/register', fn() => redirect()->route('masyarakat.register'))->name('register');

// Logout global (POST untuk keamanan)
Route::post('/logout', fn() => redirect('/'))->name('logout');

// ==========================
// Group route untuk masyarakat
// ==========================
Route::prefix('masyarakat')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('masyarakat.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('masyarakat.register.submit');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('masyarakat.login');
    Route::post('/login', [LoginController::class, 'login'])->name('masyarakat.login.submit');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('masyarakat.logout');

    // Dashboard masyarakat
    Route::get('/dashboard', [MasyarakatDashboardController::class, 'index'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.dashboard');

    // Form pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'create'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.pengaduan');

    // Submit pengaduan
    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->middleware('auth:masyarakat')
        ->name('masyarakat.pengaduan.submit');
});

// ==========================
// Group route untuk admin
// ==========================
Route::prefix('admin')->group(function () {
    // ✅ Redirect otomatis ke login kalau hanya buka /admin
    Route::get('/', fn() => redirect()->route('admin.login'))->name('admin.home');

    // Login admin
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Logout admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Semua route admin butuh autentikasi
    Route::middleware('auth:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Manajemen petugas
        Route::get('/petugas', [AdminController::class, 'petugasIndex'])->name('admin.petugas');
        Route::post('/petugas', [AdminController::class, 'storePetugas'])->name('admin.petugas.store');

        // Daftar pengaduan
        Route::get('/pengaduan', [AdminController::class, 'pengaduanIndex'])->name('admin.pengaduan');

        // Tanggapan admin
        Route::post('/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');
        Route::post('/tanggapan/{id}', [TanggapanController::class, 'store'])->name('tanggapan.store.withid');

        // Verifikasi pengaduan
        Route::post('/pengaduan/verifikasi/{id}', [AdminController::class, 'verifikasiPengaduan'])
            ->name('admin.pengaduan.verifikasi');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPDF'])->name('admin.laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('admin.laporan.excel');

        // Tanggapi pengaduan
        Route::post('/pengaduan/{id}/tanggapan', [AdminController::class, 'tanggapiPengaduan'])
            ->name('admin.pengaduan.tanggapi');
    });
});

// ==========================
// Group route untuk petugas
// ==========================
Route::prefix('petugas')->group(function () {
    // ✅ Redirect otomatis ke login kalau hanya buka /petugas
    Route::get('/', fn() => redirect()->route('petugas.login'))->name('petugas.home');

    // Login petugas
    Route::get('/login', [PetugasAuthController::class, 'showLoginForm'])->name('petugas.login');
    Route::post('/login', [PetugasAuthController::class, 'login'])->name('petugas.login.submit');

    // Logout petugas
    Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('petugas.logout');

    // Semua route petugas butuh autentikasi
    Route::middleware('auth:petugas')->group(function () {
        // Dashboard petugas
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        // Daftar pengaduan
        Route::get('/pengaduan', [PetugasPengaduanController::class, 'index'])->name('petugas.pengaduan.index');

        // Detail pengaduan + form tanggapan
        Route::get('/pengaduan/{id}', [PetugasTanggapanController::class, 'show'])
            ->name('petugas.pengaduan.show');

        // Simpan tanggapan
        Route::post('/pengaduan/{id}/tanggapan', [PetugasTanggapanController::class, 'store'])
            ->name('petugas.pengaduan.tanggapan');

        // Verifikasi pengaduan
        Route::post('/pengaduan/{id}/verifikasi', [PetugasPengaduanController::class, 'verifikasi'])
            ->name('petugas.pengaduan.verifikasi');
    });
});
