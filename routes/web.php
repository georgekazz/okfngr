<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;


Route::get('/', function() { return redirect('/el'); });
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'el|en'],
    'middleware' => \App\Http\Middleware\SetLocale::class
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

});
