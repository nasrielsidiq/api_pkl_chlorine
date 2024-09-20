<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\jobController;
use App\Http\Controllers\jobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);



Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/profile/update/{id}',[ProfileController::class, 'createProfile']);
Route::post('/password/change/{id}',[AuthController::class, 'changePassword']);

Route::post('/school/add', [SchoolController::class, 'addSchool']);
Route::post('/auth/register/admin', [AuthController::class, 'registerAdmin']);
Route::post('/user/create', [UserController::class, 'createUser']);
Route::post('/task/create', [TaskController::class, 'taskCreate']);
Route::get('/task/{id}/done', [TaskController::class, 'makeAsDone']);
Route::post('/job/create', [jobVacancyController::class, 'jobCreate']);
Route::post('/job/recommendation/create', [jobVacancyController::class, 'vacancyCreate']);

