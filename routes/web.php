<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\ApplicationController;
use App\Http\Controllers\Employer\EmployerProfileController;
Route::get('/', function () {
    return view('welcome');
});

// Role-based dashboards
Route::middleware('auth')->group(function () {

    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



Route::middleware(['auth', 'isEmployerOrAdmin'])->prefix('employer')->name('employer.')->group(function () {

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::get('/profile', [EmployerProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/image', [EmployerProfileController::class, 'updateImage'])->name('profile.image.update');

    
    Route::resource('jobs', JobController::class);

    
    Route::get('/jobs/{job}/applications', [ApplicationController::class, 'index'])->name('jobs.applications.index');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

});

require __DIR__ . '/auth.php';
