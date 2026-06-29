<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIBlogController;
use App\Http\Controllers\APIVisitorController;
use App\Http\Controllers\APILoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register

Route::post('/login', [APILoginController::class, 'login']);

Route::get('/blogs', [APIBlogController::class, 'index'])->middleware('auth:sanctum');
Route::get('/blogs/{blog}', [APIBlogController::class, 'show']);
Route::get('/blogs/{blog}/delete', [APIBlogController::class, 'delete']);
//blogs store
//blogs update

Route::get('/visitors', [APIVisitorController::class, 'index']);
Route::get('/visitors/{visitor}', [APIVisitorController::class, 'show']);
Route::get('/visitors/{visitor}/delete', [APIVisitorController::class, 'delete']);
//visitors store
//visitors update