<?php

use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

#Routes !Auth
Route::post('/login', [UserController::class, 'login'])->name('api.login');
Route::post('/register', [UserController::class, 'register'])->name('api.register');

#Routes Reservation Methods
Route::get('/estates', [EstateController::class, 'index']);
Route::get('/accommodation-types', [AccommodationController::class, 'index']);
Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/accommodations/types', [AccommodationController::class, 'getAvailableAccommodationTypes']);
Route::get('/accommodations/available', [AccommodationController::class, 'getAvailableAccommodations']);
Route::get('/activities/by-date', [ActivityController::class, 'getActivitiesByEstateAndDate']);

#Routes Auth
Route::middleware('auth:sanctum')->group(function () {
    #Routes User
    Route::get('/user', [UserController::class, 'getUserData'])->name('api.user');
    Route::post('/edit', [UserController::class, 'edit'])->name('api.edit');
    Route::post('/logout', [UserController::class, 'logout'])->name('api.logout');

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
