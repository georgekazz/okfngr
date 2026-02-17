<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Writer\MediaEventController;
use App\Http\Controllers\UserController;


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

    // Static pages
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/vision-and-values', [HomeController::class, 'whoWeAre'])->name('vision-and-values');
    Route::get('/our-impact', [HomeController::class, 'ourImpact'])->name('our-impact');
    Route::get('/our-team', [HomeController::class, 'ourTeam'])->name('our-team');
    Route::get('/in-memory', [HomeController::class, 'inMemory'])->name('in-memory');
    Route::get('/board-of-directors', [HomeController::class, 'boardOfDirectors'])->name('board-of-directors');
    Route::get('/governance', [HomeController::class, 'governance'])->name('governance');
    Route::get('/research-projects', [HomeController::class, 'researchProjects'])->name('researchProjects');
    Route::get('/applications', [HomeController::class, 'applications'])->name('applications');
    Route::get('/old-projects', [HomeController::class, 'oldProjects'])->name('oldProjects');
    Route::get('/our-actions', [HomeController::class, 'ourActions'])->name('ourActions');
    Route::get('/media', [HomeController::class, 'media'])->name('media');
    Route::get('/editions', [HomeController::class, 'editions'])->name('editions');
    Route::get('/open-data', [HomeController::class, 'openData'])->name('openData');
    Route::get('/how-to', [HomeController::class, 'howTo'])->name('howTo');
    Route::get('/why-open', [HomeController::class, 'whyOpen'])->name('whyOpen');

    // Public pages - Blog
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post:id}/comments', [PostController::class, 'storeComment'])
        ->name('posts.comments.store');


    // Writer login/logout
    Route::get('/writer/login', [WriterController::class, 'showLogin'])->name('writer.login');
    Route::post('/writer/login', [WriterController::class, 'login'])->name('writer.login.submit');
    Route::post('/writer/logout', [WriterController::class, 'logout'])->name('writer.logout');

    // Writer protected routes
    Route::middleware('auth')->prefix('writer')->name('writer.')->group(function () {
        Route::get('/dashboard', [WriterController::class, 'dashboard'])->name('dashboard');
        Route::get('/posts', [WriterController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [WriterController::class, 'create'])->name('posts.create');
        Route::post('/posts', [WriterController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post:id}/edit', [WriterController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post:id}', [WriterController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post:id}', [WriterController::class, 'destroy'])->name('posts.destroy');

        // Media Events
        Route::get('/media-events', [MediaEventController::class, 'index'])->name('media-events.index');
        Route::get('/media-events/create', [MediaEventController::class, 'create'])->name('media-events.create');
        Route::post('/media-events', [MediaEventController::class, 'store'])->name('media-events.store');
        Route::get('/media-events/{mediaEvent}/edit', [MediaEventController::class, 'edit'])->name('media-events.edit');
        Route::put('/media-events/{mediaEvent}', [MediaEventController::class, 'update'])->name('media-events.update');
        Route::delete('/media-events/{mediaEvent}', [MediaEventController::class, 'destroy'])->name('media-events.destroy');
    });

    // Admin routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user:id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user:id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::get('/users/{user:id}/reset-password', [AdminController::class, 'resetPassword'])->name('users.reset-password');
        Route::put('/users/{user:id}/password', [AdminController::class, 'updatePassword'])->name('users.update-password');
        Route::delete('/users/{user:id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Posts
        Route::get('/posts', [AdminController::class, 'posts'])->name('posts.index');
        Route::get('/posts/{post:id}/edit', [AdminController::class, 'editPost'])->name('posts.edit');
        Route::delete('/posts/{post:id}', [AdminController::class, 'destroyPost'])->name('posts.destroy');

        // Comments
        Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
        Route::patch('/comments/{comment:id}/approve', [AdminController::class, 'approveComment'])->name('comments.approve');
        Route::patch('/comments/{comment:id}/reject', [AdminController::class, 'rejectComment'])->name('comments.reject');
        Route::delete('/comments/{comment:id}', [AdminController::class, 'destroyComment'])->name('comments.destroy');

        // Team Links
        Route::get('/team-links', [AdminController::class, 'teamLinks'])->name('team-links.index');
        Route::get('/team-links/create', [AdminController::class, 'createTeamLink'])->name('team-links.create');
        Route::post('/team-links', [AdminController::class, 'storeTeamLink'])->name('team-links.store');
        Route::get('/team-links/{id}/edit', [AdminController::class, 'editTeamLink'])->name('team-links.edit');
        Route::put('/team-links/{id}', [AdminController::class, 'updateTeamLink'])->name('team-links.update');
        Route::delete('/team-links/{id}', [AdminController::class, 'destroyTeamLink'])->name('team-links.destroy');

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });

    // User routes
    Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Salary Calculator
        Route::get('/salary-calculator', [UserController::class, 'salaryCalculator'])->name('salary-calculator');

        // Day Offs
        Route::get('/day-offs', [UserController::class, 'dayOffs'])->name('day-offs.index');
        Route::get('/day-offs/create', [UserController::class, 'createDayOff'])->name('day-offs.create');
        Route::post('/day-offs', [UserController::class, 'storeDayOff'])->name('day-offs.store');
        Route::get('/day-offs/{id}/edit', [UserController::class, 'editDayOff'])->name('day-offs.edit');
        Route::put('/day-offs/{id}', [UserController::class, 'updateDayOff'])->name('day-offs.update');
        Route::delete('/day-offs/{id}', [UserController::class, 'destroyDayOff'])->name('day-offs.destroy');

        // Calendar & Links
        Route::get('/calendar', [UserController::class, 'calendar'])->name('calendar');
        Route::get('/team-links', [UserController::class, 'teamLinks'])->name('team-links');
        Route::get('/statistics', [UserController::class, 'statistics'])->name('statistics');
    });
});
