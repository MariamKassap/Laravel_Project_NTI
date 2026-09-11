<x-app-layout>

    <x-slot name="header">
        <div class="posts-header">
            <div>
                <h2 class="posts-header-title">
                    Edit Post
                </h2>
                <p class="posts-header-subtitle">
                    Update your post details
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page">

        <div class="posts-container posts-container-narrow">

            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="posts-title">Edit Post</h1>
                    <p class="form-card-subtitle">
                        Update the title, content, or media of your post.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif


                {{-- ========================= --}}
                {{-- Update Post Form --}}
                {{-- ========================= --}}

                <form
                    action="{{ route('posts.update', $post) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="post-form"
                >

                    @csrf
                    @method('PUT')


                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $post->title) }}"
                            class="form-input"
                        >
                    </div>


                    {{-- Content --}}
                    <div class="form-group">
                        <label for="content" class="form-label">Content</label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-textarea"
                            rows="6"
                        >{{ old('content', $post->content) }}</textarea>
                    </div>


                    {{-- Add New Media --}}
                    <div class="form-group">

                        <label class="form-label">Add New Images / Videos</label>

                        <div class="file-upload">
                            <input
                                type="file"
                                name="media[]"
                                multiple
                                accept="image/*,video/*"
                                id="media-upload"
                                class="file-input"
                                data-preview-target="new-media-preview"
                            >
                            <label for="media-upload" class="file-label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Choose files or drag & drop</span>
                                <small>PNG, JPG, MP4 supported</small>
                            </label>
                        </div>

                        {{-- New Media Preview (populated via JS) --}}
                        <div
                            id="new-media-preview"
                            class="media-preview-grid"
                            data-empty="true"
                        ></div>

                    </div>


                    {{-- Update --}}
                    <div class="form-actions">
                        <a href="{{ url('/posts') }}" class="btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary">
                            Update Post
                        </button>
                    </div>

                </form>

            </div>


            {{-- ========================= --}}
            {{-- Current Media --}}
            {{-- ========================= --}}

            <div class="form-card">

                <div class="form-card-header">
                    <h3 class="form-section-title">Current Media</h3>
                    <p class="form-card-subtitle">
                        Manage media attached to this post.
                    </p>
                </div>

                @if ($post->media->count())

                    <div class="media-grid">

                        @foreach ($post->media as $media)

                            <div class="post-media-item">

                                {{-- Image --}}
                                @if ($media->media_type === 'image')

                                    <img
                                        src="{{ asset('storage/' . $media->media_path) }}"
                                        alt="Post Image"
                                        class="media-preview"
                                    >

                                {{-- Video --}}
                                @elseif ($media->media_type === 'video')

                                    <video
                                        controls
                                        class="media-preview"
                                        preload="metadata"
                                    >

                                        <source
                                            src="{{ asset('storage/' . $media->media_path) }}"
                                            type="video/mp4"
                                        >

                                        Your browser does not support the video tag.

                                    </video>

                                @endif


                                {{-- Delete Media --}}
                                <form
                                    action="{{ route('post-media.destroy', $media) }}"
                                    method="POST"
                                    class="media-delete-form"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="media-delete-button"
                                        title="Delete media"
                                    >
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>

                                </form>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="media-empty">No media attached to this post.</p>

                @endif

            </div>


            {{-- Back --}}
            <div class="back-link-wrapper">
                <a href="{{ url('/posts') }}" class="back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Posts
                </a>
            </div>

        </div>

    </div>


    {{-- Posts CSS & JS --}}
    @vite([
        'resources/css/posts/posts.css',
        'resources/js/posts/posts.js'
    ])

</x-app-layout>