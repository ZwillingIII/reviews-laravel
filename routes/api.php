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
    Route::get('/', [PostsController::class, 'getPosts']);
    Route::get('/{id}', [PostsController::class, 'getPostWithReviews']);
    Route::post('/', [PostsController::class, 'addPost'])//        ->middleware(['auth:sanctum'])
    ;
});

Route::prefix('reviews')->group(function () {
    Route::get('/user/{id}', [ReviewsController::class, 'getReviewsByUser']);
    Route::get('/post/{id}', [ReviewsController::class, 'getReviewsByPost']);
    Route::post('/add/{id}', [ReviewsController::class, 'addReview'])
        ->middleware(['auth:sanctum']);
});

Route::post('like', [PostsLikesController::class, 'setLike'])->middleware(['auth:sanctum']);
//Route::post('/test',function (){
//    $ar = ['success' => true, 'payload' => request()->all()];
//
//    return response()->json($ar);
//})
//->middleware(['auth:sanctum']);

Route::get('/1', function () {
    $user = User::find(13);
    dd($user->toArray());
});
