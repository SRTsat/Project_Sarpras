<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('/users', UserController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('layout/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('kategori-barangs', \App\Http\Controllers\KategoriBarangController::class);
});

Route::resource('barangs', \App\Http\Controllers\BarangController::class);
Route::get('/peminjamans', [PeminjamanController::class, 'index'])->name('peminjamans.index');
Route::resource('pengembalians', \App\Http\Controllers\PengembalianController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::patch('/peminjamans/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('peminjamans.approve');
Route::patch('/peminjamans/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjamans.reject');
Route::delete('/peminjamans/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjamans.destroy');
Route::redirect('/', '/login');

// Laporan View
Route::get('/laporan/barang', [LaporanController::class, 'barang'])->name('laporan.barang');
Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');

// Export Excel
Route::get('/laporan/barang/excel', [LaporanController::class, 'exportBarangExcel'])->name('laporan.barang.excel');
Route::get('/laporan/peminjaman/excel', [LaporanController::class, 'exportPeminjamanExcel'])->name('laporan.peminjaman.excel');
Route::get('/laporan/pengembalian/excel', [LaporanController::class, 'exportPengembalianExcel'])->name('laporan.pengembalian.excel');