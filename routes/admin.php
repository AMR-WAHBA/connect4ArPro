<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('login',[LoginController::class,'viewLoginPage'])->name('admin.login');
Route::post('login',[LoginController::class,'attemptLogin'])->name('admin.attempt_login');
Route::get('logout',[LoginController::class,'logout']);

Route::middleware('auth:admin')->group(function () {
    Route::resource('admin', AdminController::class);
});

// if route not defined in the system;
Route::fallback([LoginController::class,'routeInvalidProccess']);


