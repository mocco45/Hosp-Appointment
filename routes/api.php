<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::middleware(['auth:sanctum','role:admin'])->prefix('v1')->group(function (){
    Route::get('/appointments', [App\Http\Controllers\DoctorController::class, 'appointment']);
    Route::get('/schedule', [App\Http\Controllers\DoctorController::class, 'schedule']);
    Route::post('/create-appointment', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('/users', [App\Http\Controllers\AuthController::class, 'index']);
});