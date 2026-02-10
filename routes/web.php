<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WriterController;

// Root redirect
Route::get('/', function () {
    return redirect('/el');
});

// Language switcher (no prefix needed)
Route::post('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// ============================================
// PUBLIC ROUTES (With /el or /en prefix)
// ============================================

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'el|en'],
    'middleware' => \App\Http\Middleware\SetLocale::class
], function () {
    
    // Public pages
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');
    
    // Writer login/logout
    Route::get('/writer/login', [WriterController::class, 'showLogin'])->name('writer.login');
    Route::post('/writer/login', [WriterController::class, 'login'])->name('writer.login.submit');
    Route::post('/writer/logout', [WriterController::class, 'logout'])->name('writer.logout');
    
    // Writer protected routes (requires auth)
    Route::middleware('auth')->prefix('writer')->name('writer.')->group(function () {
        Route::get('/dashboard', [WriterController::class, 'dashboard'])->name('dashboard');
        Route::get('/posts/create', [WriterController::class, 'create'])->name('posts.create');
        Route::post('/posts', [WriterController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [WriterController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [WriterController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [WriterController::class, 'destroy'])->name('posts.destroy');
    });
});