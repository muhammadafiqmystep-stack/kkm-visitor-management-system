<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
Route::get('/visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
Route::post('/visitors/create', [VisitorController::class, 'store'])->name('visitors.store');