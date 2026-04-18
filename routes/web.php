<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PharmacyStockController;
use App\Http\Controllers\PrescriptionOrderController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('appointments', AppointmentController::class)->except(['show']);
Route::resource('ehr', HealthRecordController::class)->except(['show']);
Route::resource('payments', PaymentController::class)->except(['show']);
Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
Route::resource('pharmacy/stocks', PharmacyStockController::class)->names('pharmacy.stocks')->except(['show']);
Route::resource('pharmacy/orders', PrescriptionOrderController::class)->names('pharmacy.orders')->except(['show']);
