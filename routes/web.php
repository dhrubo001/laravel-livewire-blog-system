<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [RegisterController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('postRegister');
});
Route::middleware(['auth', 'log.activity'])->group(function () {
    Route::get('/logout', [LoginController::class, 'postLogout'])->name('postLogout');
});
Route::prefix('user')->middleware(['auth', 'role:user', 'log.activity'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('getDashboard');
    Route::get('/post/create', [PostController::class, 'getPostCreate'])->name('getPostCreate');
    Route::get('/post/{slug}', [PostController::class, 'getPostRead'])->name('getPostRead');
    Route::get('/post/update/{slug}', [PostController::class, 'getPostUpdate'])->name('getPostUpdate');
});

Route::prefix('admin')->middleware(['auth', 'role:admin', 'log.activity'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('admin.dashboard');
    Route::get('/post/create', [PostController::class, 'getPostCreate'])->name('admin.getPostCreate');
    Route::get('/post/{slug}', [PostController::class, 'getPostRead'])->name('admin.getPostRead');
    Route::get('/post/update/{slug}', [PostController::class, 'getPostUpdate'])->name('admin.getPostUpdate');
});
