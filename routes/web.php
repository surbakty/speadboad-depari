<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// 2. Route Google Auth (Agar error google.login tidak muncul lagi)
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// 3. Route Dashboard Admin (Hapus middleware 'auth' untuk sementara agar bisa masuk)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// 4. Route Tambahan Lainnya
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/cek-tiket', [BookingController::class, 'show'])->name('tiket.cek');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');   
})->name('logout');

Route::get('/tiket-saya', [App\Http\Controllers\BookingController::class, 'myHistory'])->name('tiket.saya')->middleware('auth');

Route::get('/tiket/detail/{kode_tiket}', [BookingController::class, 'detail'])->name('tiket.detail')->middleware('auth');

// Route untuk user upload bukti bayar
Route::post('/tiket/upload', [BookingController::class, 'uploadBukti'])->name('tiket.upload')->middleware('auth');

// Route untuk melihat data transaksi
Route::get('/admin/transaksi', [App\Http\Controllers\AdminController::class, 'dataTransaksi'])->name('admin.transaksi');

// Route untuk tombol konfirmasi
Route::post('/admin/konfirmasi/{id}', [App\Http\Controllers\AdminController::class, 'konfirmasiLunas'])->name('admin.konfirmasi');

// Route untuk Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Route untuk Halaman Transaksi
Route::get('/admin/transaksi', [AdminController::class, 'dataTransaksi'])->name('admin.transaksi');