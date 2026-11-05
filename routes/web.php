<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FineController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;


//public
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Modul Utama Perpustakaan (Menggunakan Controller Asli)
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    
    Route::get('/loans/report', [LoanController::class, 'report'])->name('loans.report');
    Route::resource('loans', LoanController::class);
    Route::put('/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])->name('loans.kembalikan');

    // Profil Pengguna
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Modul Denda (Fitur baru kita)
    Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
    Route::post('/fines/{id}/pay', [FineController::class, 'markAsPaid'])->name('fines.pay');

    // Admin Only Routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
});