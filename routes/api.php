<?php

use App\Http\Api\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

Route::post('auth', [\App\Http\Api\Controllers\AuthController::class, 'auth'])->name('api.auth');
Route::post('validate', [\App\Http\Api\Controllers\ValidationController::class, 'phoneValidate'])->name('api.phone.validate');
Route::prefix('posts')->group(function () {
    Route::get('/', [\App\Http\Controllers\PostsController::class, 'getPosts']);
    Route::get('/{id}', [\App\Http\Controllers\PostsController::class, 'getPostWithReviews']);
    Route::post('/add', [\App\Http\Controllers\PostsController::class, 'addPost'])->middleware(['auth:sanctum']);
});
Route::prefix('reviews')->group(function () {
    Route::get('/user/{id}', [ReviewsController::class, 'getReviewsByUser']);
    Route::get('/post/{id}', [ReviewsController::class, 'getReviewsByPost']);
    Route::post('/add/{id}', [ReviewsController::class, 'addReview'])->middleware(['auth:sanctum']);
});
//Route::post('/test',function (){
//    $ar = ['success' => true, 'payload' => request()->all()];
//
//    return response()->json($ar);
//})
//->middleware(['auth:sanctum']);
