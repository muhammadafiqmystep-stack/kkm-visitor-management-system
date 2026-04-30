<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
Route::get('/visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
Route::post('/visitors/create', [VisitorController::class, 'store'])->name('visitors.store');
Route::get('/visitors/{visitor}', [VisitorController::class, 'show'])->name('visitors.show');
Route::get('/visitors/{visitor}/edit', [VisitorController::class, 'edit'])->name('visitors.edit');
Route::post('/visitors/{visitor}/edit', [VisitorController::class, 'update'])->name('visitors.update');
Route::get('/visitors/{visitor}/delete', [VisitorController::class, 'delete'])->name('visitors.delete');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs/create', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/{blog}/edit', [BlogController::class, 'update'])->name('blogs.update');
Route::get('/blogs/{blog}/delete', [BlogController::class, 'delete'])->name('blogs.delete');