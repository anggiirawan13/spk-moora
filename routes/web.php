<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\SubCriteriaController;
use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\CalculationController;
use App\Http\Controllers\Admin\CarBrandController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\FuelTypeController;
use App\Http\Controllers\Admin\TransmissionTypeController;

Auth::routes();

Route::get('/404', function () {
    return response()->view('admin.errors.404', [], 404);
})->name('error.custom.404');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/delete-image', [UserController::class, 'deleteProfileImage'])->name('profile.delete_image');

    Route::resource('/car', CarController::class)->names('car');
    Route::get('/car/compare/form', [CarController::class, 'showComparisonForm'])->name('car.compare.form');
    Route::post('/car/compare', [CarController::class, 'compare'])->name('car.compare');

    Route::resource('/criteria', CriteriaController::class)->names('criteria');
    Route::resource('/sub-criteria', SubCriteriaController::class)->names('subcriteria');
    Route::resource('/alternative', AlternativeController::class)->names('alternative');
    Route::get('/calculation', [CalculationController::class, 'calculation'])->name('calculation');
    Route::get('/admin/moora/report', [CalculationController::class, 'downloadPDF'])->name('moora.download_pdf');

    Route::name('admin.')->middleware('admin')->group(function () {
        Route::resource('/user', UserController::class)->names('user');
        Route::resource('/transmission', TransmissionTypeController::class)->names('transmission_type');
        Route::resource('/fuel', FuelTypeController::class)->names('fuel_type');
        Route::resource('/type', CarTypeController::class)->names('car_type');
        Route::resource('/brand', CarBrandController::class)->names('car_brand');
    });
});
