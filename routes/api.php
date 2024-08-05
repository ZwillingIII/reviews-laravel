<?php

use App\Http\Api\Controllers\AuthController;
use App\Http\Api\Controllers\PostsLikesController;
use App\Http\Api\Controllers\ReviewsController;
use App\Http\Api\Controllers\ValidationController;
use App\Http\Controllers\PostsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::post('auth', [AuthController::class, 'auth'])->name('api.auth');
Route::post('validate', [ValidationController::class, 'phoneValidate'])->name('api.phone.validate');

Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'getPage']);
    Route::get('/{id}', [PostsController::class, 'getPost']);
    Route::post('/', [PostsController::class, 'create'])
        ->middleware(['auth:sanctum'])
        ->middleware('throttle:2,1440');
});

Route::prefix('reviews')->group(function () {
    Route::get('/user/{id}', [ReviewsController::class, 'getReviewsByUser']);
    Route::get('/post/{id}', [ReviewsController::class, 'getReviewsByPost']);
    Route::post('/add', [ReviewsController::class, 'addReview'])
        ->middleware(['auth:sanctum']);
});

Route::post('like', [PostsLikesController::class, 'setLike'])->middleware(['auth:sanctum']);
