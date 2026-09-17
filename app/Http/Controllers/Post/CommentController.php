<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // mariam added 
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use AuthorizesRequests; // Fixes authorization method call
    public function store(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        $comment->load('user');

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'user_name' => $comment->user->name,
            'delete_url' => route('comments.destroy', $comment),
            'can_delete' => Auth::id() === $comment->user_id
                || Auth::isAdmin(),

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
