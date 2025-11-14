<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KelolaBarangController;
use App\Http\Controllers\PostingBarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
