<x-app-layout>

    <x-slot name="header">
        <div class="posts-header">
            <div>
                <h2 class="posts-header-title">
                    Create Post
                </h2>
                <p class="posts-header-subtitle">
                    Share something with the community
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page">

        <div class="posts-container posts-container-narrow">

            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="posts-title">Create Post</h1>
                    <p class="form-card-subtitle">
                        Fill in the details below to publish your post.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form
                    action="{{ route('posts.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="post-form"
                >

                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-input"
                            placeholder="Give your post a title..."
                        >
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Content</label>

                        <textarea
                            id="content"
                            name="content"
                            class="form-textarea"
                            placeholder="What would you like to share?"
                            rows="6"
                        >{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Images / Videos</label>

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

                    <div class="form-actions">
                        <a href="{{ url('/posts') }}" class="btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary">
                            Create Post
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    @vite([
        'resources/css/posts/posts.css',
        'resources/js/posts/posts.js'
    ])

</x-app-layout>