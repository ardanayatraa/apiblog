<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\TagController;

// Rute tanpa autentikasi (tanpa login dan middleware)

// API Resource untuk Blog
Route::apiResource('blogs', BlogController::class);

// API Resource untuk kategori, tag, komentar, likes, dan media
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('likes', LikeController::class);
Route::apiResource('media', MediaController::class);

// Rute untuk homepage
Route::get('/', function () {
    return view('welcome');
});


Route::get('/docs', function () {
    return view('idoc.documentation');  // Sesuaikan dengan view atau controller yang menghasilkan dokumentasi
});
