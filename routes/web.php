<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\JobController;
use App\Http\Controllers\Employee\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\ApplicationController;
use App\Http\Controllers\Employer\EmployerProfileController;
Route::get('/', function () {
    return view('welcome');
});

//mariam employee routes
Route::middleware(['auth', 'role:employee'])->group(function () {

    // Employee Dashboard
    Route::get('/employee/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    // Employee Applications
    Route::get('/employee/applications', [ApplicationController::class, 'index'])->name('employee.applications.index');

    Route::get('/employee/applications/{application}', [ApplicationController::class, 'show'])->name('employee.applications.show');

    // Apply for a job - show CV selection
    Route::get('/employee/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('employee.jobs.apply');

    // Apply for a job - submit application
    Route::post('/employee/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('employee.jobs.store');


    // Employee Jobs
    Route::get('/employee/jobs', [JobController::class, 'index'])->name('employee.jobs.index');

    Route::get('/employee/jobs/{job}', [JobController::class, 'show'])->name('employee.job.show');
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
