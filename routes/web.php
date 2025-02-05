<?php

use App\Http\Controllers\accommodation\AccommodationController;
use App\Http\Controllers\accommodation\AccommodationTypeController;
use App\Http\Controllers\activity\ActivityController;
use App\Http\Controllers\activity\ActivityTypeController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\login\ChangePassword;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\login\ResetPassword;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserProfileController;
use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;
use App\Models\activity\Activity;
use App\Models\Billing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

#Routes HomePage
Route::get('/', function () {
    return view('pages.home', [
        'activities' => Activity::take(3)->get(),
        'accommodations' => Accommodation::take(9)->get(),
        'accommodation_types' => AccommodationType::take(3)->get(),
    ]);
})->name('home');
Route::get('/cart/add/{id}/{quantity}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation.create');
Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');





Route::group(['middleware' => 'guest'], function () {
    #Routes Auth
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform')->middleware('throttle:5,1');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');

    ### Route Dev ###
    Route::get('/login/admin', [LoginController::class, 'loginAdmin'])->name('login.admin');
    Route::get('/login/client', [LoginController::class, 'loginClient'])->name('login.client');
});



Route::group(['middleware' => 'auth'], function () {

    #Route Clients



    Route::resource('products', ProductController::class)->except(['index']);;
    Route::get('/checkout', function () {
        $isReservation = request('isReservation', false);
        return view('pages.checkout.index', compact('isReservation'));
    })->name('checkout');

    Route::get('/account', function () {
        return view('pages.client.account');
    })->name('account');

    Route::get('/personal-info', function () {
        return view('pages.client.personal-info');
    })->name('personal-info');
    Route::get('/personal-info/{user}', [UserController::class, 'edit'])->name('personal-info.edit');
    Route::put('/personal-info/{user}', [UserController::class, 'update'])->name('personal-info.update');
    Route::get('/payment-methods', function () {
        return view('pages.client.payment-methods');
    })->name('payment-methods');
    Route::get('/orders', function () {
        return view('pages.client.orders');
    })->name('orders');
    Route::get('/wishlist', function () {
        return view('pages.client.wishlist');
    })->name('wishlist');
    Route::get('/history', function () {
        return view('pages.client.history');
    })->name('history');
    Route::get('/reviews', function () {
        return view('pages.client.reviews');
    })->name('reviews');
    Route::get('/support', function () {
        return view('client.support');
    })->name('support');


    #Routes Address
    Route::put('/users/{user}/storeAddress', [UserController::class, 'storeAddress'])->name('users.storeAddress');
    Route::delete('/users/{user}/addresses/{address}', [UserController::class, 'destroyUserAddress'])->name('users.destroyUserAddress');

    #Routes Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    #Routes Admin
    Route::middleware('role:admin')->group(function () {

        #Routes Dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/sales_overview', [HomeController::class, 'salesOverview'])->name('sales.overview');

        #Routes Estates
        Route::resource('estates', EstateController::class);
        Route::post('/estates/{estate}/recover', [EstateController::class, 'recover'])->name('estates.recover');

        #Routes Users
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::post('/users/{user}/recover', [UserController::class, 'recover'])->name('users.recover');
        Route::resource('users', UserController::class);

        #Routes Accommodations
        Route::resource('accommodations', AccommodationController::class)->except(['index']);
        Route::resource('accommodation_types', AccommodationTypeController::class);

        #Routes Activities
        Route::resource('activities', ActivityController::class);
        Route::resource('activity_types', ActivityTypeController::class);
    });
});
