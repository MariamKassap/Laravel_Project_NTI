<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\JsonResponse;

class PostLikeController extends Controller
{
    public function store(Post $post): JsonResponse
    {
        PostLike::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'liked' => true,
            'likes_count' => $post->likes()->count(),
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        PostLike::where('post_id', $post->id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json([
            'liked' => false,
            'likes_count' => $post->likes()->count(),
        ]);
    }
}