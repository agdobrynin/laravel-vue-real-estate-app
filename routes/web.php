<?php

use App\Http\Controllers\Apartment;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RealtorApartmentController;
use App\Http\Controllers\RealtorApartmentImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

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

Route::resource('apartment', Apartment::class)
    ->only(['index', 'show']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function () {
        Route::name('apartment.restore')
            ->put('apartment/{apartment}/restore', [RealtorApartmentController::class, 'restore'])
            ->withTrashed()
        ;

        Route::resource(
            'apartment',
            RealtorApartmentController::class)
            ->only(['index', 'destroy', 'create', 'store', 'edit', 'update'])
            ->withTrashed();

        Route::resource('apartment.image', RealtorApartmentImageController::class)
            ->only(['create', 'store', 'destroy']);
    });
