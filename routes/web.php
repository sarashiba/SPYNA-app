<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Login (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Proses Register (POST)
Route::post('/register', function () {
    // logika registrasi manual bisa ditambahkan di sini nanti
})->name('register.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin dashboard (hanya untuk admin@gmail.com)
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::resource('questions', App\Http\Controllers\Admin\QuestionController::class);
// });

// User dashboard (semua user yang bukan admin)
// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('questions', App\Http\Controllers\Admin\QuestionController::class);

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

Route::get('/', function () {
    return view('user.home');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', function () {
    return view('user.contact');
});
