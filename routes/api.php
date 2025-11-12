<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::middleware(['auth:sanctum','role:admin,patient'])->prefix('v1')->group(function (){
    Route::get('/schedule', [App\Http\Controllers\DoctorController::class, 'schedule']);
    Route::post('/create-appointment', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::put('/update-appointment/{appointment}', [App\Http\Controllers\AppointmentController::class, 'update']);
    Route::get('/appointments', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/doctors', [App\Http\Controllers\UserController::class, 'doctors']);
    Route::get('/patients', [App\Http\Controllers\UserController::class, 'patients']);
});
