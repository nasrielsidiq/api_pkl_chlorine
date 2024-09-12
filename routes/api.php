<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/home/create/profile',[ProfileController::class, 'createProfile']);
Route::post('/home/profile/{id}',[ProfileController::class, 'updateProfile']);
Route::post('/home/change-password/{id}',[ProfileController::class, 'changePassword']);
