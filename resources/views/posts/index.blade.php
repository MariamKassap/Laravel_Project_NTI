<x-app-layout>

    <x-slot name="header">
        <div class="posts-header">
            <div>
                <h2 class="posts-header-title">
                    Community
                </h2>
                <p class="posts-header-subtitle">
                    Discover what's happening in your network
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page">

        <div class="posts-container">

            {{-- Page Hero --}}
            <div class="posts-hero">
                <div class="posts-hero-text">
                    <span class="posts-hero-badge">COMMUNITY FEED</span>
                    <h1 class="posts-title">All Posts</h1>
                    <p class="posts-subtitle">
                        Share your thoughts, ideas, and opportunities with the community.
                    </p>
                </div>

                @auth
                <a
                    href="{{ url('/posts/create') }}"
                    class="create-post-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Create Post
                </a>
                @endauth
            </div>

            {{-- Posts Feed --}}
            <div class="posts-feed">

                @forelse ($posts as $post)

                <article class="post-card">

                    {{-- Post Header --}}
                    <div class="post-header">

                        <div class="post-avatar">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>

                        <div class="post-header-info">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>

                            <p class="post-author">
                                <span class="post-author-name">{{ $post->user->name }}</span>
                                @if($post->created_at)
                                <span class="post-dot">•</span>
                                <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
                                @endif
                            </p>
                        </div>

                    </div>


                    {{-- Post Content --}}
                    <div class="post-content">
                        <p>{{ $post->content }}</p>
                    </div>


                    {{-- Media Gallery --}}
                    @if($post->media->count())

                    @php
                    $mediaItems = $post->media->values();
                    $mediaCount = $mediaItems->count();
                    $visibleCount = min($mediaCount, 4);
                    $visibleMedia = $mediaItems->take($visibleCount);
                    $remaining = $mediaCount - $visibleCount;
                    @endphp

                    <div
                        class="post-gallery"
                        data-media-count="{{ $mediaCount }}"
                        data-gallery-count="{{ $visibleCount }}">

                        @foreach ($visibleMedia as $index => $media)

                        @php
                        $mediaUrl = asset('storage/' . $media->media_path);
                        $isLastVisible = ($index === $visibleCount - 1);
                        $showOverlay = $isLastVisible && $remaining > 0;
                        @endphp

                        <div
                            class="gallery-item gallery-item-{{ $visibleCount }} gallery-pos-{{ $index }}"
                            data-gallery-index="{{ $index }}"
                            data-gallery-post="{{ $post->id }}"
                            role="button"
                            tabindex="0"
                            aria-label="Open media {{ $index + 1 }} of {{ $mediaCount }}">

                            @if ($media->media_type === 'image')

                            <img
                                src="{{ $mediaUrl }}"
                                alt="Post Image"
                                class="gallery-media"
                                loading="lazy"
                                data-media-type="image"
                                data-media-src="{{ $mediaUrl }}">

                            @elseif ($media->media_type === 'video')

                            <video
                                class="gallery-media"
                                preload="metadata"
                                muted
                                playsinline
                                data-media-type="video"
                                data-media-src="{{ $mediaUrl }}">
                                <source
                                    src="{{ $mediaUrl }}"
                                    type="video/mp4">
                            </video>

                            {{-- Video Play Icon --}}
                            <div class="gallery-play-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>

                            @endif

                            @if ($showOverlay)
                            <div class="gallery-overlay">
                                <span class="gallery-overlay-text">
                                    +{{ $remaining }}
                                </span>
                            </div>
                            @endif

                        </div>

                        @endforeach

                        {{-- Hidden data: all media (for lightbox navigation) --}}
                        <div
                            class="gallery-hidden-data"
                            data-post-id="{{ $post->id }}"
                            hidden>
                            @foreach ($mediaItems as $i => $m)
                            <span
                                data-idx="{{ $i }}"
                                data-type="{{ $m->media_type }}"
                                data-src="{{ asset('storage/' . $m->media_path) }}"></span>
                            @endforeach
                        </div>

                    </div>

                    @endif


                    {{-- Edit / Delete --}}
                    @auth

                    @if (
                    $post->user_id === auth()->id()
                    || auth()->user()->isAdmin()
                    )

                    <div class="post-management">

                        <a
                            href="{{ route('posts.edit', $post) }}"
                            class="edit-button">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit
                        </a>

                        <form
                            action="{{ route('posts.destroy', $post) }}"
                            method="POST"
                            class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                                onclick="return confirm('Are you sure you want to delete this post?')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                Delete
                            </button>

                        </form>

                    </div>

                    @endif

                    @endauth


                    {{-- Likes --}}
                    <div class="post-actions">

                        <span class="likes-count">
                            <strong>{{ $post->likes->count() }}</strong>

                        </span>

                        @auth

                        <form
                            action="{{ $post->likes->contains('user_id', auth()->id())
                                        ? route('posts.unlike', $post)
                                        : route('posts.like', $post) }}"
                            method="POST"
                            class="like-form">

                            @csrf

                            @if ($post->likes->contains('user_id', auth()->id()))
                            @method('DELETE')
                            @endif

                            <button
                                type="submit"
                                class="like-button {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}">
                                <span class="like-icon">
                                    {{ $post->likes->contains('user_id', auth()->id()) ? '❤️' : '🤍' }}
                                </span>
                                <span class="like-text">
                                    {{ $post->likes->contains('user_id', auth()->id()) ? 'Unlike' : 'Like' }}
                                </span>
                            </button>

                        </form>

                        @endauth

                    </div>


                    {{-- Comments --}}
                    <div class="post-comments">

                        <h3 class="comments-title">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Comments
                            <span class="comments-count">{{ $post->comments->count() }}</span>
                        </h3>

                        <div class="comments-list">

                            @foreach ($post->comments as $comment)

                            <div class="comment">

                                <div class="comment-avatar">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>

                                <div class="comment-body">

                                    <strong class="comment-author">
                                        {{ $comment->user->name }}
                                    </strong>

                                    <p class="comment-content">
                                        {{ $comment->content }}
                                    </p>

                                    @auth

                                    @if (
                                    $comment->user_id === auth()->id()
                                    || auth()->user()->isAdmin()
                                    )

                                    <form
                                        action="{{ route('comments.destroy', $comment) }}"
                                        method="POST"
                                        class="comment-delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="comment-delete-button">
                                            Delete
                                        </button>

                                    </form>

                                    @endif

                                    @endauth

                                </div>

                            </div>

                            @endforeach

                        </div>


                        {{-- Add Comment --}}
                        @auth

                        <form
                            action="{{ route('comments.store', $post) }}"
                            method="POST"
                            class="comment-form">

                            @csrf

                            <div class="comment-input-wrapper">
                                <div class="comment-avatar comment-avatar-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <input
                                    type="text"
                                    name="content"
                                    placeholder="Write a comment..."
                                    class="comment-input"
                                    autocomplete="off">
                            </div>

                            <button
                                type="submit"
                                class="comment-button">
                                Post
                            </button>

                        </form>

                        @endauth

                    </div>

                </article>

                @empty

                <div class="posts-empty">
                    <div class="posts-empty-icon">📝</div>
                    <h3>No posts yet</h3>
                    <p>Be the first to share something with the community.</p>
                </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ============================================ --}}
    {{-- Lightbox (single instance per page) --}}
    {{-- ============================================ --}}
    <div
        id="post-lightbox"
        class="lightbox"
        hidden
        role="dialog"
        aria-modal="true"
        aria-label="Media lightbox">
        {{-- Close --}}
        <button
            type="button"
            class="lightbox-close"
            aria-label="Close lightbox"
            data-lightbox-close>
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        {{-- Previous --}}
        <button
            type="button"
            class="lightbox-nav lightbox-prev"
            aria-label="Previous media"
            data-lightbox-prev>
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        {{-- Media Stage --}}
        <div class="lightbox-stage" data-lightbox-stage>
            {{-- Content injected via JS --}}
        </div>

        {{-- Next --}}
        <button
            type="button"
            class="lightbox-nav lightbox-next"
            aria-label="Next media"
            data-lightbox-next>
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>

        {{-- Counter --}}
        <div class="lightbox-counter" data-lightbox-counter></div>
    </div>


    @vite([
    'resources/css/posts/posts.css',
    'resources/js/posts/posts.js'
    ])

</x-app-layout>