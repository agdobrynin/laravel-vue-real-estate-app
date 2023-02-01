<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentOfferController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorAcceptOfferController;
use App\Http\Controllers\RealtorApartmentController;
use App\Http\Controllers\RealtorApartmentImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::resource('apartment', ApartmentController::class)
    ->only(['index', 'show']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::resource('apartment.offer', ApartmentOfferController::class)
    ->middleware(['auth', 'verified'])
    ->only(['store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::name('apartment.restore')
            ->put('apartment/{apartment}/restore', [RealtorApartmentController::class, 'restore'])
            ->withTrashed()
        ;

        Route::resource(
            'apartment',
            RealtorApartmentController::class)
            ->withTrashed();

        Route::name('accept.offer')
            ->put('offer/{offer}/accept', RealtorAcceptOfferController::class);

        Route::resource('apartment.image', RealtorApartmentImageController::class)
            ->only(['create', 'store', 'destroy'])
            ->withTrashed(['create', 'store', 'destroy']);

    });

Route::resource('notification', NotificationController::class)
    ->middleware(['auth', 'verified'])
    ->only(['index']);

Route::put('/notification/{notification}/seen', NotificationSeenController::class)
    ->name('notification.seen')
    ->middleware(['auth', 'verified']);

Route::get('/email/verify', fn () =>  Inertia::render('Auth/VerifyEmail'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('apartment.index')->with('success', 'Email was verified');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return redirect()->route('apartment.index')->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
