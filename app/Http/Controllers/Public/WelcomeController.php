<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        // Reuse existing Jobs and Posts queries - read-only, no auth required
        $jobs = Job::with('employer')
            ->latest()
            ->take(6)
            ->get();

        $posts = Post::with(['user', 'media', 'likes', 'comments'])
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('jobs', 'posts'));
    }
}
