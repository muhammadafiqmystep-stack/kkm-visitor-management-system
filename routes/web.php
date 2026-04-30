<?php

use Illuminate\Support\Facades\Route;
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