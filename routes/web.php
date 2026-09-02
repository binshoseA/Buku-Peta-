<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

// Mencegah error 404 setelah berhasil register/login
Route::redirect('/home', '/dashboard');

// Halaman Onboarding (Awal)
Route::get('/', function () {
    return view('index'); 
});

// Autentikasi (Bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Fitur Aplikasi (Wajib login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
// Dashboard & Riwayat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [TransactionController::class, 'history'])->name('history');
    
    // Fitur Ekspor Excel
    Route::get('/export-excel', [TransactionController::class, 'exportExcel'])->name('export.excel');
    // Transaksi
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Akun & Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});