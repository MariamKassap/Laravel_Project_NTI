<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\JobController;
use App\Http\Controllers\Employee\ApplicationController;
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

// Employer Dashboard
Route::get('/employer/dashboard', function () {
    return view('employer.dashboard');
})->name('employer.dashboard');

// Admin Dashboard
// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');
// Profile
Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');


require __DIR__ . '/auth.php';
