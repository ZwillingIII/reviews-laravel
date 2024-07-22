<?php
use Illuminate\Support\Facades\Route;

Route::post('auth', [\App\Http\Api\Controllers\AuthController::class, 'auth'])->name('api.auth');
Route::post('validate', [\App\Http\Api\Controllers\ValidationController::class, 'phoneValidate'])->name('api.phone.validate');
