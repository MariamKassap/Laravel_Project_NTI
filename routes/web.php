<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostLikeController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Role-based dashboards
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

    // Like / Unlike
    Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])
        ->name('posts.like');

    Route::delete('/posts/{post}/like', [PostLikeController::class, 'destroy'])
        ->name('posts.unlike');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    // Post Edit / Update / Delete
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    // Delete Post Media
    Route::delete('/post-media/{media}', [PostController::class, 'destroyMedia'])
        ->name('post-media.destroy');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});

// Posts
Route::get('/posts', [PostController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create']);

    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
});

require __DIR__ . '/auth.php';