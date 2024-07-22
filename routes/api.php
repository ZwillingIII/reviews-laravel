<?php
use Illuminate\Support\Facades\Route;

Route::post('auth', [\App\Http\Api\Controllers\AuthController::class, 'auth'])->name('api.auth');
Route::post('validate', [\App\Http\Api\Controllers\ValidationController::class, 'phoneValidate'])->name('api.phone.validate');
Route::get('posts', [\App\Http\Controllers\PostsController::class, 'getPage']);
//Route::post('/test',function (){
//    $ar = ['success' => true, 'payload' => request()->all()];
//
//    return response()->json($ar);
//})
//->middleware(['auth:sanctum']);
