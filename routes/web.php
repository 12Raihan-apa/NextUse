<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KelolaBarangController;
use App\Http\Controllers\PostingBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SyaratKetentuanController;

Route::get('/', function () {
    return view('beranda');
});


Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes untuk posting barang (menambahkan barang)
Route::get('/barang/create', [PostingBarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [PostingBarangController::class, 'store'])->name('barang.store');

// Routes untuk kelola barang (edit dan hapus)
Route::get('/barang/{item}/edit', [KelolaBarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{item}', [KelolaBarangController::class, 'update'])->name('barang.update');
Route::patch('/barang/{item}', [KelolaBarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{item}', [KelolaBarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/syarat-ketentuan', [SyaratKetentuanController::class, 'index'])->name('syarat-ketentuan');

