<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManagerController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'viewLoginPage'])->name('admin.login');
Route::post('login', [LoginController::class, 'attemptLogin'])->name('admin.attempt_login');
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware(['auth:admin', 'redirect_admin_depend_on_type'])->group(function () {
    Route::resources(
        [
            'manager' => ManagerController::class,
            'admin' => AdminController::class,
        ]
    );

});

// if route not defined in the system;
Route::fallback([LoginController::class, 'routeInvalidProccess']);
