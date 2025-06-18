<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('buku', \App\Http\Controllers\BukuController::class);
Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class);

Route::get('/peminjaman_eksport/pdf', [PeminjamanController::class, 'exportPDF'])->name('peminjaman_eksport.export.pdf');
Route::get('/buku_eksport/pdf', [BukuController::class, 'exportPDF'])->name('buku_eksport.export.pdf');

