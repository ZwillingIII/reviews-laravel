<?php
use Illuminate\Support\Facades\Route;

Route::post('auth', [\App\Http\Api\Controllers\AuthController::class, 'index'])->name('api.auth');
