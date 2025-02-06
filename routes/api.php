<?php

use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

#Routes !Auth
Route::post('/login', [UserController::class, 'login'])->name('api.login');
Route::post('/register', [UserController::class, 'register'])->name('api.register');

#Routes Auth
Route::middleware('auth:sanctum')->group(function () {
    #Routes User
    Route::get('/user', [UserController::class, 'getUserData'])->name('api.user');
    Route::post('/edit', [UserController::class, 'edit'])->name('api.edit')->middleware('auth:sanctum');
    Route::post('/logout', [UserController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');

    #Routes User billing information
    Route::get('/billing', [UserController::class, 'getBillingInfo'])->name('api.billing.get');
    Route::post('/billing/update', [UserController::class, 'updateBillingInfo'])->name('api.billing.update');
    Route::post('/billing/address/update', [UserController::class, 'updateBillingAddress'])->name('api.billing.address.update');

    #Routes Payment Methods
    Route::get('/payment-methods', [PaymentMethodController::class, 'index']);
    Route::post('/payment-methods', [PaymentMethodController::class, 'store']);
    Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy']);
    Route::post('/payment-methods/{id}/set-default', [PaymentMethodController::class, 'setDefault']);

});
