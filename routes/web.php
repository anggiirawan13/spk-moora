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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Berikut adalah daftar rute yang digunakan dalam aplikasi ini.
|--------------------------------------------------------------------------
*/

// ==========================
// ✅ Guest Routes (Tanpa Login)
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/detail/{mobil:slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('contact.store');
Route::get('/spk', [HomeController::class, 'spk'])->name('spk');

Auth::routes();

// ==========================
// ✅ Authenticated User Routes (Harus Login)
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 🔹 Hanya Bisa Diakses oleh User yang Login
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // 🔹 User Biasa Bisa Mengakses Mobil, Kriteria, Alternatif
    Route::resource('/mobil', CarController::class);
    Route::resource('/kriteria', CriteriaController::class);
    Route::resource('/alternatif', AlternativeController::class);
    Route::get('/hitung', [CalculationController::class, 'hitung'])->name('hitung');
});

// ==========================
// ✅ Admin Routes (Hanya Admin)
// ==========================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    // 🔹 Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // 🔹 CRUD User (Hanya Admin)
    Route::resource('/user', UserController::class);

    Route::resource('/car_types', CarTypeController::class);
    Route::resource('/car_brands', CarBrandController::class);
});
