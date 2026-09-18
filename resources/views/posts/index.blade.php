<x-app-layout>

    <x-slot name="header">
        <div class="posts-header flex items-center justify-between gap-4">
            <div>
                <h2 class="posts-header-title text-xl font-black text-black">
                    Community
                </h2>
                <p class="posts-header-subtitle text-sm font-bold text-slate-600">
                    Discover what's happening in your network
                </p>
            </div>
        </div>
    </x-slot>

    <div class="posts-page bg-[#F4F0EA] min-h-screen">

        <div class="posts-container max-w-3xl mx-auto px-4 sm:px-6 py-8">

            {{-- Page Hero --}}
            <div class="posts-hero flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8 pb-6 border-b-2 border-black">
                <div class="posts-hero-text">
                    <span class="posts-hero-badge inline-flex items-center px-2.5 py-1 rounded-md text-xs font-black tracking-widest border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">COMMUNITY FEED</span>
                    <h1 class="posts-title text-3xl font-black text-black tracking-tight mt-3">All Posts</h1>
                    <p class="posts-subtitle text-sm font-bold text-slate-600 mt-1 max-w-lg">
                        Share your thoughts, ideas, and opportunities with the community.
                    </p>
                </div>

                @auth
                <a
                    href="{{ url('/posts/create') }}"
                    class="create-post-button inline-flex items-center gap-2 bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all whitespace-nowrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Create Post
                </a>
                @endauth
            </div>

            {{-- Posts Feed --}}
            <div class="posts-feed flex flex-col gap-6">

                @forelse ($posts as $post)

                <article class="post-card bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] p-6">

                    {{-- Post Header --}}
                    <div class="post-header flex items-start gap-3 mb-4">

                        <div class="post-avatar w-10 h-10 shrink-0 rounded-full bg-blue-200 border-2 border-black shadow-[2px_2px_0px_0px_#000000] flex items-center justify-center font-black text-black text-sm">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>

                        <div class="post-header-info flex-1 min-w-0">
                            <h2 class="post-title text-lg font-black text-black leading-tight">
                                {{ $post->title }}
                            </h2>

                            <p class="post-author flex items-center gap-1.5 flex-wrap text-sm mt-1">
                                <span class="post-author-name font-black text-black">{{ $post->user->name }}</span>
                                @if($post->created_at)
                                <span class="post-dot text-slate-400 font-bold">•</span>
                                <span class="post-date font-bold text-slate-600">{{ $post->created_at->diffForHumans() }}</span>
                                @endif
                            </p>
                        </div>

                    </div>


                    {{-- Post Content --}}
                    <div class="post-content text-[15px] font-medium text-black leading-relaxed break-words">
                        <p class="m-0 whitespace-pre-wrap">{{ $post->content }}</p>
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
                        class="post-gallery mt-4 grid gap-1 rounded-xl overflow-hidden border-2 border-black bg-slate-100"
                        data-media-count="{{ $mediaCount }}"
                        data-gallery-count="{{ $visibleCount }}">

                        @foreach ($visibleMedia as $index => $media)

                        @php
                        $mediaUrl = asset('storage/' . $media->media_path);
                        $isLastVisible = ($index === $visibleCount - 1);
                        $showOverlay = $isLastVisible && $remaining > 0;
                        @endphp

                        <div
                            class="gallery-item gallery-item-{{ $visibleCount }} gallery-pos-{{ $index }} relative overflow-hidden cursor-pointer bg-black"
                            data-gallery-index="{{ $index }}"
                            data-gallery-post="{{ $post->id }}"
                            role="button"
                            tabindex="0"
                            aria-label="Open media {{ $index + 1 }} of {{ $mediaCount }}">

                            @if ($media->media_type === 'image')

                            <img
                                src="{{ $mediaUrl }}"
                                alt="Post Image"
                                class="gallery-media w-full h-full object-cover block"
                                loading="lazy"
                                data-media-type="image"
                                data-media-src="{{ $mediaUrl }}">

                            @elseif ($media->media_type === 'video')

                            <video
                                class="gallery-media w-full h-full object-cover block"
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
                            <div class="gallery-play-icon absolute inset-0 flex items-center justify-center text-white pointer-events-none" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="w-11 h-11 p-2.5 rounded-full bg-black/60 border-2 border-white/20 backdrop-blur">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>

                            @endif

                            @if ($showOverlay)
                            <div class="gallery-overlay absolute inset-0 flex items-center justify-center bg-black/55 backdrop-blur-[2px] text-white text-2xl font-black">
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

                    <div class="post-management flex items-center gap-2 mt-4">

                        <a
                            href="{{ route('posts.edit', $post) }}"
                            class="edit-button inline-flex items-center gap-1.5 bg-white text-black font-bold border-2 border-black rounded-lg px-3 py-1.5 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit
                        </a>

                        <form
                            action="{{ route('posts.destroy', $post) }}"
                            method="POST"
                            class="delete-form inline m-0">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button inline-flex items-center gap-1.5 bg-red-500 text-white font-bold border-2 border-black rounded-lg px-3 py-1.5 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-red-600 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all"
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
                    <div class="post-actions flex items-center justify-between gap-3 mt-5 pt-4 border-t-2 border-black">

                        <span class="likes-count text-sm font-bold text-black">
                            <strong class="font-black">{{ $post->likes->count() }}</strong> {{ \Illuminate\Support\Str::plural('Like', $post->likes->count()) }}

                        </span>

                        @auth

                        <form
                            action="{{ $post->likes->contains('user_id', auth()->id())
                                        ? route('posts.unlike', $post)
                                        : route('posts.like', $post) }}"
                            method="POST"
                            class="like-form inline m-0">

                            @csrf

                            @if ($post->likes->contains('user_id', auth()->id()))
                            @method('DELETE')
                            @endif

                            <button
                                type="submit"
                                class="like-button inline-flex items-center gap-1.5 font-bold border-2 border-black rounded-full px-3 py-1.5 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all {{ $post->likes->contains('user_id', auth()->id()) ? 'liked bg-rose-300 text-black' : 'bg-white text-black hover:bg-slate-100' }}">
                                <span class="like-icon text-sm leading-none">
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
                    <div class="post-comments mt-5 pt-5 border-t-2 border-black">

                        <h3 class="comments-title flex items-center gap-2 m-0 mb-4 text-xs font-black text-black uppercase tracking-widest">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-black">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Comments
                            <span class="comments-count inline-flex items-center px-2 py-0.5 rounded-md text-xs font-black border border-black bg-blue-200 text-black shadow-[1px_1px_0px_0px_#000000]">{{ $post->comments->count() }}</span>
                        </h3>

                        <div class="comments-list flex flex-col gap-2">

                            @foreach ($post->comments as $comment)

                            <div class="comment flex gap-2.5 py-2 border-b-2 border-black/5 last:border-0">

                                <div class="comment-avatar w-8 h-8 shrink-0 rounded-full bg-blue-200 border-2 border-black flex items-center justify-center font-black text-xs text-black">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>

                                <div class="comment-body flex-1 min-w-0">

                                    <strong class="comment-author block text-sm font-black text-black">
                                        {{ $comment->user->name }}
                                    </strong>

                                    <p class="comment-content m-0 text-sm font-medium text-black break-words leading-relaxed">
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
                                        class="comment-delete-form inline-block mt-1">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="comment-delete-button bg-white text-red-600 font-bold border border-black rounded-md px-2 py-0.5 text-xs shadow-[1px_1px_0px_0px_#000000] hover:bg-red-500 hover:text-white transition-colors">
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
                            class="comment-form flex gap-2 mt-4 items-center">

                            @csrf

                            <div class="comment-input-wrapper flex-1 flex items-center gap-2 bg-white border-2 border-black rounded-full px-2 py-1 shadow-[2px_2px_0px_0px_#000000] focus-within:ring-0">
                                <div class="comment-avatar comment-avatar-sm w-7 h-7 shrink-0 rounded-full bg-blue-200 border-2 border-black flex items-center justify-center font-black text-xs text-black">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <input
                                    type="text"
                                    name="content"
                                    placeholder="Write a comment..."
                                    class="comment-input flex-1 px-2 py-1 border-none bg-transparent outline-none text-sm font-medium text-black placeholder:text-slate-500 focus:ring-0"
                                    autocomplete="off">
                            </div>

                            <button
                                type="submit"
                                class="comment-button bg-[#2563EB] text-white font-bold border-2 border-black rounded-full px-5 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all whitespace-nowrap">
                                Post
                            </button>

                        </form>

                        @endauth

                    </div>

                </article>

                @empty

                <div class="posts-empty text-center py-16 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                    <div class="posts-empty-icon text-4xl mb-3">📝</div>
                    <h3 class="m-0 mb-1 text-lg font-black text-black">No posts yet</h3>
                    <p class="m-0 text-sm font-bold text-slate-600">Be the first to share something with the community.</p>
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
        class="lightbox fixed inset-0 z-[9999] bg-black/90 flex items-center justify-center p-14"
        hidden
        role="dialog"
        aria-modal="true"
        aria-label="Media lightbox">
        {{-- Close --}}
        <button
            type="button"
            class="lightbox-close absolute top-4 right-4 w-11 h-11 flex items-center justify-center bg-white border-2 border-black rounded-full shadow-[2px_2px_0px_0px_#000000] text-black hover:bg-slate-100 transition"
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
            class="lightbox-nav lightbox-prev absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center bg-white border-2 border-black rounded-full shadow-[2px_2px_0px_0px_#000000] text-black hover:bg-slate-100 transition z-10"
            aria-label="Previous media"
            data-lightbox-prev>
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        {{-- Media Stage --}}
        <div class="lightbox-stage relative max-w-full max-h-full flex items-center justify-center" data-lightbox-stage>
            {{-- Content injected via JS --}}
        </div>

        {{-- Next --}}
        <button
            type="button"
            class="lightbox-nav lightbox-next absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center bg-white border-2 border-black rounded-full shadow-[2px_2px_0px_0px_#000000] text-black hover:bg-slate-100 transition z-10"
            aria-label="Next media"
            data-lightbox-next>
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>

        {{-- Counter --}}
        <div class="lightbox-counter absolute bottom-5 left-1/2 -translate-x-1/2 bg-white border-2 border-black rounded-full px-3 py-1 text-xs font-black text-black shadow-[2px_2px_0px_0px_#000000]" data-lightbox-counter></div>
    </div>


    @vite([
    'resources/css/posts/posts.css',
    'resources/js/posts/posts.js'
    ])

</x-app-layout>
