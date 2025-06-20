<?php

use Illuminate\Support\Facades\Route;

// --- Controllers Publik (bisa diakses tanpa namespace Admin) ---
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserQuizController; // Untuk user quiz, bukan admin

// --- Controllers Admin (dari namespace Admin) ---
use App\Http\Controllers\AdminController;       // Pastikan AdminController ada di folder App\Http\Controllers\Admin
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\SpiritController as AdminSpiritController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


// =========================================================
// --- ROUTE PUBLIK (Tidak memerlukan login / autentikasi) ---
// =========================================================

// Halaman utama (landing page)
Route::get('/', function () {
    return view('user.home');
})->name('home'); 

// Halaman About
Route::get('/about', function () {
    return view('user.about');
})->name('about'); 

// Halaman Contact
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Halaman Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Login (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Proses Register (POST)
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Proses Logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// =========================================================
// --- ROUTE YANG MEMERLUKAN AUTENTIKASI (Sudah Login) ---
// =========================================================
Route::middleware('auth')->group(function () {
    
    // === ROUTE ADMIN (Memerlukan login DAN hak akses admin) ===
    // Semua route di dalam grup ini akan dilindungi oleh AdminMiddleware
    // Route::middleware('admin')->group(function () { // Grup middleware 'admin' yang sudah didaftarkan di Kernel.php
    Route::middleware(['web', 'auth', 'admin'])->group(function () {
   
        // Dashboard Admin
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Resource untuk Manajemen Pertanyaan Admin
        // URL: /admin/questions, Nama: admin.questions.*
        Route::resource('admin/questions', AdminQuestionController::class)->names('admin.questions');
        
        // Resource untuk Manajemen Spirit Admin
        // URL: /admin/spirits, Nama: admin.spirits.*
        Route::resource('admin/spirits', AdminSpiritController::class)->names('admin.spirits');
        
        // Resource untuk Manajemen User Admin
        // URL: /admin/users, Nama: admin.users.*
        Route::resource('admin/users', AdminUserController::class)->names('admin.users');
    });

    // === ROUTE KUIS PENGGUNA (Hanya memerlukan login, bukan admin) ===
    // Route ini berada di dalam 'auth' middleware group tapi di luar 'admin' middleware group
    
    // Halaman utama kuis (langsung ke pertanyaan pertama)
    // URL: /quiz, Nama: user.quiz.show
    Route::get('/quiz', [UserQuizController::class, 'showQuiz'])->name('user.quiz.show');
    
    // API untuk mengambil data pertanyaan (AJAX)
    // URL: /quiz/get-question, Nama: user.quiz.get_question_data
    Route::get('/quiz/get-question', [UserQuizController::class, 'getQuestionData'])->name('user.quiz.get_question_data');

    // API untuk submit jawaban (AJAX)
    // URL: /quiz/submit-answer, Nama: user.quiz.submit_answer
    Route::post('/quiz/submit-answer', [UserQuizController::class, 'submitAnswer'])->name('user.quiz.submit_answer');
    
    // Halaman hasil kuis
    // URL: /quiz/result, Nama: user.quiz.result
    Route::get('/quiz/result', [UserQuizController::class, 'showResult'])->name('user.quiz.result');
});

// =========================================================
// --- AKHIR ROUTE YANG MEMERLUKAN AUTENTIKASI ---
// =========================================================