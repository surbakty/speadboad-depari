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