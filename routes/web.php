<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| Web Routes — Sistem Informasi Perpustakaan
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Data Buku — Resource Routes (index, create, store, edit, update, destroy)
Route::resource('buku', BukuController::class);

// Data Anggota — Resource Routes
Route::resource('anggota', AnggotaController::class);

// Peminjaman — Export Routes
Route::get('peminjaman/export/pdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.export.pdf');
Route::get('peminjaman/export/excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.export.excel');

// Peminjaman — Resource Routes + Pengembalian
Route::resource('peminjaman', PeminjamanController::class);
Route::put('peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])
     ->name('peminjaman.kembali');
