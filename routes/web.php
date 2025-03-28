<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\CalculationController;
use App\Http\Controllers\Admin\CarBrandController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\FuelTypeController;
use App\Http\Controllers\Admin\TransmissionTypeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::resource('/car', CarController::class);
    Route::resource('/criteria', CriteriaController::class);
    Route::resource('/alternative', AlternativeController::class);
    Route::get('/calculation', [CalculationController::class, 'calculation'])->name('calculation');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/user', UserController::class);
    Route::resource('/transmission_type', TransmissionTypeController::class);
    Route::resource('/fuel_type', FuelTypeController::class);
    Route::resource('/car_type', CarTypeController::class);
    Route::resource('/car_brand', CarBrandController::class);
});
