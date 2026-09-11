<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        $comment->load('user');

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'user_name' => $comment->user->name,
            'delete_url' => route('comments.destroy', $comment),
            'can_delete' => auth()->id() === $comment->user_id
                || auth()->user()->isAdmin(),
        ]);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}