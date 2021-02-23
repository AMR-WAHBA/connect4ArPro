<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('login',[LoginController::class,'viewLoginPage'])->name('admin.login');

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('/', AdminController::class);
});

// if route not defined in the system;
Route::fallback([LoginController::class,'viewLoginPage']);
