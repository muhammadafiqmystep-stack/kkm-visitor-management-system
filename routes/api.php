<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIBlogController;
use App\Http\Controllers\APIVisitorController;
use App\Http\Controllers\APILoginController;
use App\Http\Controllers\APIRegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [APIRegisterController::class, 'register']);

Route::post('/login', [APILoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blogs', [APIBlogController::class, 'index']);
    Route::get('/blogs/{blog}', [APIBlogController::class, 'show']);
    Route::get('/blogs/{blog}/delete', [APIBlogController::class, 'delete']);
    Route::post('/blogs', [APIBlogController::class, 'store']);
    Route::post('/blogs/{blog}', [APIBlogController::class, 'edit']);

    Route::get('/visitors', [APIVisitorController::class, 'index']);
    Route::get('/visitors/{visitor}', [APIVisitorController::class, 'show']);
    Route::get('/visitors/{visitor}/delete', [APIVisitorController::class, 'delete']);
    Route::post('/visitors', [APIVisitorController::class, 'store']);
    Route::post('/visitors/{visitor}', [APIVisitorController::class, 'edit']);
});