<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\JobController as EmployeeJobController;
use App\Http\Controllers\Employee\ApplicationController as EmployeeApplicationController;

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
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');

    // Employee Applications
    Route::get('/employee/applications', [EmployeeApplicationController::class, 'index'])->name('employee.applications.index');

    Route::get('/employee/applications/{application}', [EmployeeApplicationController::class, 'show'])->name('employee.applications.show');

    // Apply for a job - show CV selection
    Route::get('/employee/jobs/{job}/apply', [EmployeeApplicationController::class, 'create'])->name('employee.jobs.apply');

    // Apply for a job - submit application
    Route::post('/employee/jobs/{job}/apply', [EmployeeApplicationController::class, 'store'])->name('employee.jobs.store');

    // Employee Jobs
    Route::get('/employee/jobs', [EmployeeJobController::class, 'index'])->name('employee.jobs.index');

    Route::get('/employee/jobs/{job}', [EmployeeJobController::class, 'show'])->name('employee.job.show');
});


// Admin Dashboard
// Route::get('/admin', function () {
//    return view('admin.dashboard');
//})->name('admin.dashboard');
// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [ProfileController::class, 'updateImage'])
    ->name('profile.image.update');
});

Route::middleware(['auth', 'isEmployerOrAdmin'])->prefix('employer')->name('employer.')->group(function () {

    
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

    
    Route::resource('jobs', EmployerJobController::class);

    
    Route::get('/jobs/{job}/applications', [EmployerApplicationController::class, 'index'])->name('jobs.applications.index');
    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

});

require __DIR__ . '/auth.php';
