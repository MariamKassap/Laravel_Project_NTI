<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with([
            'user',
            'media',
            'comments.user',
            'likes'
        ])
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|array|max:10',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,webm|max:51200',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $file) {

                $path = $file->store('posts', 'public');

                $mediaType = str_starts_with(
                    $file->getMimeType(),
                    'image/'
                )
                    ? 'image'
                    : 'video';

                PostMedia::create([
                    'post_id' => $post->id,
                    'media_type' => $mediaType,
                    'media_path' => $path,
                ]);
            }
        }

        return redirect('/posts');
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $post->load('media');

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|array|max:10',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,webm|max:51200',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Add new media
        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $file) {

                $path = $file->store('posts', 'public');

                $mediaType = str_starts_with(
                    $file->getMimeType(),
                    'image/'
                )
                    ? 'image'
                    : 'video';

                PostMedia::create([
                    'post_id' => $post->id,
                    'media_type' => $mediaType,
                    'media_path' => $path,
                ]);
            }
        }

        return redirect('/posts');
    }


    public function destroyMedia(PostMedia $media)
    {
        $this->authorize('update', $media->post);

        Storage::disk('public')->delete(
            $media->media_path
        );

        $media->delete();

        return response()->json([
            'success' => true,
        ]);
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        foreach ($post->media as $media) {

            Storage::disk('public')->delete(
                $media->media_path
            );
        }

        $post->delete();

        return redirect('/posts');
    }
}