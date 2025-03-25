<?php

use \App\Http\Controllers\Admin\CriteriaController;
use \App\Http\Controllers\Admin\AlternativeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('homepage');
Route::get('/detail/{mobil:slug}', [\App\Http\Controllers\HomeController::class,'detail'])->name('detail');
Route::get('/about', [\App\Http\Controllers\HomeController::class,'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\HomeController::class,'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\HomeController::class,'contactStore'])->name('contact.store');
Route::get('spk',[\App\Http\Controllers\HomeController::class,'spk'])->name('spk');

Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard.index')
->middleware('is_admin');

Route::get('/admin/messages',[\App\Http\Controllers\Admin\MessageController::class,'index'])->name('admin.message.index');

Route::resource('/admin/mobil', \App\Http\Controllers\Admin\CarController::class);
Route::resource('/admin/kriteria', CriteriaController::class);
Route::resource('/admin/alternatif', AlternativeController::class);
Route::get('/admin/hitung', [\App\Http\Controllers\Admin\CalculationController::class, 'hitung'])->name('hitung');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
