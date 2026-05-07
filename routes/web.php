<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

// Landing page
Route::get('/landing', function () {
    return view('landing');
})->name('landing');

// Landing page redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/landing');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require auth)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search Rak Buku (AJAX)
    Route::get('/api/search-buku', [BukuController::class, 'search'])->name('buku.search');

    // Cari Rak Buku Page
    Route::get('/perpustakaan/cari-rak', [BukuController::class, 'cariRak'])->name('cari-rak.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.foto');
    Route::delete('/profile/foto', [ProfileController::class, 'deleteFoto'])->name('profile.foto.delete');

    // Siswa Routes
    Route::resource('/perpustakaan/siswa', SiswaController::class, [
        'names' => [
            'index' => 'siswa.index',
            'create' => 'siswa.create',
            'store' => 'siswa.store',
            'edit' => 'siswa.edit',
            'update' => 'siswa.update',
            'destroy' => 'siswa.destroy',
        ]
    ]);

    // Kategori Routes
    Route::resource('/perpustakaan/kategori', KategoriController::class, [
        'names' => [
            'index' => 'kategori.index',
            'create' => 'kategori.create',
            'store' => 'kategori.store',
            'edit' => 'kategori.edit',
            'update' => 'kategori.update',
            'destroy' => 'kategori.destroy',
        ]
    ]);

    // Buku Routes
    Route::resource('/perpustakaan/buku', BukuController::class, [
        'names' => [
            'index' => 'buku.index',
            'create' => 'buku.create',
            'store' => 'buku.store',
            'show' => 'buku.show',
            'edit' => 'buku.edit',
            'update' => 'buku.update',
            'destroy' => 'buku.destroy',
        ]
    ]);

    // Peminjaman Routes
    Route::resource('/perpustakaan/peminjaman', PeminjamanController::class, [
        'names' => [
            'index' => 'peminjaman.index',
            'create' => 'peminjaman.create',
            'store' => 'peminjaman.store',
            'edit' => 'peminjaman.edit',
            'update' => 'peminjaman.update',
            'destroy' => 'peminjaman.destroy',
        ]
    ]);

    // Laporan Routes
    Route::get('/perpustakaan/laporan/histori-denda', [PeminjamanController::class, 'historiDenda'])->name('laporan.histori-denda');
    Route::get('/perpustakaan/laporan/denda-siswa/{siswa_id}', [PeminjamanController::class, 'historiDendaSiswa'])->name('laporan.denda-siswa');
    Route::get('/perpustakaan/laporan/denda-bulanan', [PeminjamanController::class, 'rekapDendaBulanan'])->name('laporan.denda-bulanan');

    // User Routes
    Route::resource('/perpustakaan/user', UserController::class, [
        'names' => [
            'index' => 'user.index',
            'create' => 'user.create',
            'store' => 'user.store',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ]
    ]);

    // Settings Routes
    Route::get('/perpustakaan/pengaturan', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/perpustakaan/pengaturan', [SettingController::class, 'update'])->name('settings.update');
});
