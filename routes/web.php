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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserProfileController;
use App\Models\accommodation\Accommodation;
use App\Models\accommodation\AccommodationType;
use App\Models\activity\Activity;
use App\Models\Product;
use App\Models\user\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Home Page Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home', [
        'activities' => Activity::take(3)->get(),
        'accommodation_types' => AccommodationType::take(3)->get(),
        'top_products' => Product::select('products.*')
            ->join('orders_products', 'products.id', '=', 'orders_products.product_id')
            ->selectRaw('SUM(orders_products.quantity) as total_sold')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(9)
            ->get(),
    
    ]);
})->name('home');

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->group(function () {
    Route::get('/add/{id}/{quantity}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/index', [CartController::class, 'index'])->name('cart.index');
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
});

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/
Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/account/verify/{id}', [UserController::class, 'verify'])->name('account.verify');

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::prefix('email')->group(function () {
    Route::get('/verify', fn() => view('auth.verify-email'))->name('verification.notice');
    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })->middleware(['signed'])->name('verification.verify');
    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('success', 'Verification link sent!');
    })->middleware([ 'throttle:6,1'])->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform')->middleware(['throttle:5,1']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');

    # Different user login routes
    Route::get('/login/admin', [LoginController::class, 'loginAdmin'])->name('login.admin');
    Route::get('/login/client', [LoginController::class, 'loginClient'])->name('login.client');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    # Reservations and Checkout
    Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation.create');
    Route::resource('orders', OrderController::class)->except(['index']);
    Route::resource('products', ProductController::class)->except(['index']);
    
    Route::get('/checkout', function () {
        return view('pages.checkout.index', ['isReservation' => request('isReservation', false)]);
    })->name('checkout');

    # User Account
    Route::get('/account', fn() => view('pages.client.account'))->name('account');
    Route::get('/personal-info', fn() => view('pages.client.personal-info'))->name('personal-info');
    Route::get('/personal-info/{user}', [UserController::class, 'edit'])->name('personal-info.edit');
    Route::put('/personal-info/{user}', [UserController::class, 'update'])->name('personal-info.update');
    Route::get('/payment-methods', fn() => view('pages.client.payment-methods'))->name('payment-methods');
    Route::get('/orders', fn() => view('pages.client.orders'))->name('orders.index');
    Route::get('/wishlist', fn() => view('pages.client.wishlist'))->name('wishlist');
    Route::get('/history', fn() => view('pages.client.history'))->name('history');
    Route::get('/reviews', fn() => view('pages.client.reviews'))->name('reviews');
    Route::get('/support', fn() => view('client.support'))->name('support');

    # User Addresses
    Route::put('/users/{user}/storeAddress', [UserController::class, 'storeAddress'])->name('users.storeAddress');
    Route::delete('/users/{user}/addresses/{address}', [UserController::class, 'destroyUserAddress'])->name('users.destroyUserAddress');

    # Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Admin Only)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        # Dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/sales_overview', [HomeController::class, 'salesOverview'])->name('sales.overview');

        # Estate Management
        Route::resource('estates', EstateController::class);
        Route::post('/estates/{estate}/recover', [EstateController::class, 'recover'])->name('estates.recover');

        # User Management
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::post('/users/{user}/recover', [UserController::class, 'recover'])->name('users.recover');
        Route::resource('users', UserController::class);

        # Accommodation Management
        Route::resource('accommodations', AccommodationController::class)->except(['index']);
        Route::resource('accommodation_types', AccommodationTypeController::class);

        # Activity Management
        Route::resource('activities', ActivityController::class);
        Route::resource('activity_types', ActivityTypeController::class);
    });
});
