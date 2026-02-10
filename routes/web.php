<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WriterController;

Route::get('/', function () {
    return redirect('/el');
});

Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where('locale', 'el|en');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'el|en'],
    'middleware' => \App\Http\Middleware\SetLocale::class
], function () {

    // Public pages - USE SLUG
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post:slug}/comments', [PostController::class, 'storeComment'])
        ->name('posts.comments.store');

    // Writer login/logout
    Route::get('/writer/login', [WriterController::class, 'showLogin'])->name('writer.login');
    Route::post('/writer/login', [WriterController::class, 'login'])->name('writer.login.submit');
    Route::post('/writer/logout', [WriterController::class, 'logout'])->name('writer.logout');

    // Writer protected routes - USE ID
    Route::middleware('auth')->prefix('writer')->name('writer.')->group(function () {
        Route::get('/dashboard', [WriterController::class, 'dashboard'])->name('dashboard');
         Route::get('/posts', [WriterController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [WriterController::class, 'create'])->name('posts.create');
        Route::post('/posts', [WriterController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post:id}/edit', [WriterController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post:id}', [WriterController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post:id}', [WriterController::class, 'destroy'])->name('posts.destroy');
    });
});