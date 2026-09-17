<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; //mariam added 
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use AuthorizesRequests; // Add trait here 
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

    //mariam test validation 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|array|max:10',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,webm|max:51200',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(), // Resolves "Undefined method 'id'"
            'title' => $validated['title'],
            'content' => $validated['content'], // Resolves "protected visibility"
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

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|array|max:10',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,webm|max:51200',
        ]);
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
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

        Storage::disk('public')->delete($media->media_path);

        $media->delete();

        return response()->json([
            'success' => true,
        ]);
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        foreach ($post->media as $media) {

            Storage::disk('public')->delete($media->media_path);
        }
        $post->media()->delete(); // Clean up media records explicitly
        $post->delete();

        return redirect('/posts');
    }
}
