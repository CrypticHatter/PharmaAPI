<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MedicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('v1')->group(function () {
    Route::get('customer', [CustomerController::class, 'index']);
    Route::post('customer', [CustomerController::class, 'store'])->middleware('role:owner');
    Route::put('customer/{id}', [CustomerController::class, 'update'])->middleware('role:owner,manager,cashier');
    Route::delete('customer/{id}', [CustomerController::class, 'destroy'])->middleware('role:owner,manager');
    Route::delete('customer/{id}/delete', [CustomerController::class, 'force'])->middleware('role:owner');

    Route::get('medication', [MedicationController::class, 'index']);
    Route::post('medication', [MedicationController::class, 'store'])->middleware('role:owner');
    Route::put('medication/{id}', [MedicationController::class, 'update'])->middleware('role:owner,manager,cashier');
    Route::delete('medication/{id}', [MedicationController::class, 'destroy'])->middleware('role:owner,manager');
    Route::delete('medication/{id}/delete', [MedicationController::class, 'force'])->middleware('role:owner');
})->middleware(['auth:sanctum']);
