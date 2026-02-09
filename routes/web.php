<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WriterController;


Route::get('/', function () {
    return redirect('/el');
});
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/writer/login', [WriterController::class, 'showLogin'])->name('writer.login');
Route::post('/writer/login', [WriterController::class, 'login'])->name('writer.login.submit');
Route::post('/writer/logout', [WriterController::class, 'logout'])->name('writer.logout');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'el|en'],
    'middleware' => \App\Http\Middleware\SetLocale::class
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

});

// Writer Protected Routes
Route::middleware('auth')->prefix('writer')->name('writer.')->group(function () {
    Route::get('/dashboard', [WriterController::class, 'dashboard'])->name('dashboard');
    Route::get('/posts/create', [WriterController::class, 'create'])->name('posts.create');
    Route::post('/posts', [WriterController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [WriterController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [WriterController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [WriterController::class, 'destroy'])->name('posts.destroy');
});
