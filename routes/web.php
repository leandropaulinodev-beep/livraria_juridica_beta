<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// 🔑 Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// 🆕 Registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🔒 Rotas protegidas
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 📚 CRUD Livros
    Route::resource('books', BookController::class)->except(['show']);

    //⬆️ Importação CSV (Livros)
    Route::get('/books/import', [BookController::class, 'importForm'])->name('books.import.form');
    Route::post('/books/import', [BookController::class, 'importCsv'])->name('books.import.csv');

    // 📑 Relatório PDF (Livros)
    Route::get('/books/report/pdf', [BookController::class, 'reportPdf'])->name('books.report.pdf');

  // 📊 Gráfico de livros por assunto
Route::get('/books/chart', [BookController::class, 'chart'])->name('books.chart');

    // 📝 CRUD Assuntos
    Route::resource('subjects', SubjectController::class);

    // 👤 CRUD Autores
    Route::resource('authors', AuthorController::class);

    // 🚪 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
