<?php

use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

#Routes !Auth
Route::post('/login', [UserController::class, 'login'])->name('api.login');
Route::post('/register', [UserController::class, 'register'])->name('api.register');

#Routes Auth
Route::middleware('auth:sanctum')->group(function () {


    #Routes User
    Route::post('/edit', [UserController::class, 'edit'])->name('api.edit')->middleware('auth:sanctum');
    Route::post('/logout', [UserController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');
});
