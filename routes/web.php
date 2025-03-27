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
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CarBrandController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::resource('/mobil', CarController::class);
    Route::resource('/kriteria', CriteriaController::class);
    Route::resource('/alternatif', AlternativeController::class);
    Route::get('/hitung', [CalculationController::class, 'hitung'])->name('hitung');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/user', UserController::class);
    Route::resource('/car_types', CarTypeController::class);
    Route::resource('/car_brands', CarBrandController::class);
});
