<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

// Role-based dashboards & Auth routes
Route::middleware('auth')->group(function () {

    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    // Admin Section
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('jobs', JobController::class);
        Route::resource('applications', ApplicationController::class);
    });

    // Profile Routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__ . '/auth.php';