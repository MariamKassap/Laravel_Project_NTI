<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employee\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Employee Dashboard
    Route::get('/employee/dashboard', [DashboardController::class, 'index'])
        ->name('employee.dashboard');
    // Employee Applications
    Route::get('/employee/applications', function () {
        return view('employee.applications.index');
    })->name('employee.applications.index');

    Route::get('/employee/applications/{id}', function ($id) {
        return view('employee.applications.show');
    })->name('employee.applications.show');

    // Employee Jobs
    Route::get('/employee/jobs', function () {
        return view('employee.jobs.index');
    })->name('employee.jobs.index');

    Route::get('/employee/jobs/{id}', function ($id) {
        return view('employee.jobs.show');
    })->name('employee.job.show');


    // Employer Dashboard
    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    // Admin Dashboard
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


require __DIR__ . '/auth.php';
