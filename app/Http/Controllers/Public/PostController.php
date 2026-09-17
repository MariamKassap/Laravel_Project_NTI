<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Public community browsing - reuses Post\PostController index logic
     * Read-only for guests, Create/Like/Comment remain behind auth.
     */
    public function index()
    {
        $posts = Post::with([
            'user',
            'media',
            'comments.user',
            'likes'
        ])
            ->latest()
            ->paginate(10);

        return view('public.posts.index', compact('posts'));
    }
}
