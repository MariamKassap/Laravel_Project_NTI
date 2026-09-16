<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\JobController;
use App\Http\Controllers\Employee\ApplicationController;

use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Employer\ApplicationController as EmployerApplicationController;
use App\Http\Controllers\Employer\EmployerProfileController;

use Illuminate\Support\Facades\Route;
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

    
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

    
    Route::get('/profile', [EmployerProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/image', [EmployerProfileController::class, 'updateImage'])->name('profile.image.update');

    
    Route::resource('jobs', EmployerJobController::class);

    
    Route::get('/jobs/{job}/applications', [EmployerApplicationController::class, 'index'])->name('jobs.applications.index');
    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

});

require __DIR__ . '/auth.php';
