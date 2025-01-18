<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\TagController;

Route::prefix('api')->group(function () {
Route::apiResource('blogs', BlogController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('likes', LikeController::class);
Route::apiResource('media', MediaController::class);
});
// Rute untuk homepage
Route::get('/', function () {
    return view('idoc.documentation');
});



