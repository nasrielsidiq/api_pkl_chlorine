<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\jobController;
use App\Http\Controllers\jobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/profile/create/{id}',[ProfileController::class, 'createProfile']);
// Route::post('/profile/update/{id}',[ProfileController::class, 'updateProfile']);
Route::post('/password/change/{id}',[ProfileController::class, 'changePassword']);

Route::post('/auth/register/admin', [AuthController::class, 'registerAdmin']);
Route::post('/task/create', [TaskController::class, 'taskCreate']);
Route::post('/job/create', [jobVacancyController::class, 'jobCreate']);
Route::post('/vacancy/recommendation', [jobVacancyController::class, 'vacancyCreate']);

