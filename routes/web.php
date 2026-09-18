<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\JobController as EmployeeJobController;
use App\Http\Controllers\Employee\ApplicationController as EmployeeApplicationController;

use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Employer\ApplicationController as EmployerApplicationController;
use App\Http\Controllers\Employer\EmployerProfileController;

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostLikeController;
use App\Http\Controllers\Post\CommentController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $activeJobsCount = \App\Models\Job::where(function ($q) {
        $q->whereNull('deadline')->orWhereDate('deadline', '>=', today());
    })->count();
    $totalJobsCount = \App\Models\Job::count();
    $candidatesCount = \App\Models\User::where('role', 'employee')->count();
    $discussionsCount = \App\Models\Post::count();
    $totalApplications = \App\Models\Application::count();
    $acceptedApplications = \App\Models\Application::where('status', 'accepted')->count();
    $placementRate = $totalApplications > 0 ? (int) round($acceptedApplications / $totalApplications * 100) : null;

    $featuredPost = \App\Models\Post::with(['user', 'likes', 'comments'])->latest()->first();
    $latestPosts = \App\Models\Post::with(['user', 'likes', 'comments'])->latest()->take(3)->get();
    $latestJobs = \App\Models\Job::with('employer')->latest()->take(4)->get();

    return view('welcome', compact(
        'activeJobsCount',
        'totalJobsCount',
        'candidatesCount',
        'discussionsCount',
        'totalApplications',
        'placementRate',
        'featuredPost',
        'latestPosts',
        'latestJobs'
    ));
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

// Community — public read, auth required to interact
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Profile + Posts (auth required to interact)
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/image', [ProfileController::class, 'updateImage'])
        ->name('profile.image.update');

    //posts by mariam 
    Route::post('/profile/cv', [ProfileController::class, 'storeCV'])
        ->name('profile.cv.store');

    Route::delete('/profile/cv/{cv}', [ProfileController::class, 'destroyCV'])
        ->name('profile.cv.destroy');

    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');

    // Post Edit / Update / Delete
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    // Delete Post Media
    Route::delete('/post-media/{media}', [PostController::class, 'destroyMedia'])
        ->name('post-media.destroy');

    // Likes
    Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])
        ->name('posts.like');

    Route::delete('/posts/{post}/like', [PostLikeController::class, 'destroy'])
        ->name('posts.unlike');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});


//salma employer 
Route::middleware(['auth', 'isEmployerOrAdmin'])->prefix('employer')->name('employer.')->group(function () {

    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

    Route::resource('jobs', EmployerJobController::class);

    Route::get('/jobs/{job}/applications', [EmployerApplicationController::class, 'index'])->name('jobs.applications.index');

    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    //mariam added while testing 
    Route::get('/applications/{application}', [EmployerApplicationController::class, 'show'])
        ->name('applications.show');
});

require __DIR__ . '/auth.php';
