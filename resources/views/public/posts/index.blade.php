<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Community - {{ config('app.name', 'JobConnect') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/posts/posts.css', 'resources/js/posts/posts.js'])
    @endif
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-700">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center">J</div>
                    <span class="font-bold text-slate-800">JobConnect</span>
                </a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('public.jobs.index') }}" class="text-sm text-slate-600">Jobs</a>
                    <a href="{{ route('public.posts.index') }}" class="text-sm text-blue-600 font-medium">Community</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-sm">Sign In</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-xl">Register</a>
                    @else
                        <a href="{{ route('posts.create') }}" class="hidden sm:inline-flex px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl">Create Post</a>
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-sm font-bold text-blue-700">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-slate-900">Community</h1>
            <p class="text-slate-500 mt-2">Public browsing — <i class="fa-solid fa-lock text-[10px]"></i> sign in to create, like, or comment.</p>
            @guest
                <div class="mt-4 inline-flex gap-2">
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-slate-900 text-white text-sm font-semibold rounded-xl">Sign In to Interact</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 border border-slate-200 bg-white text-sm font-semibold rounded-xl">Register</a>
                </div>
            @else
                <a href="{{ route('posts.create') }}" class="inline-flex mt-4 px-6 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl"><i class="fa-solid fa-plus text-xs"></i> Create Post</a>
            @endguest
        </div>

        <div class="space-y-6">
            @forelse($posts as $post)
                <article class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                    <div class="flex gap-3 mb-4">
                        <div class="w-9 h-9 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-sm">{{ strtoupper(substr($post->user->name,0,1)) }}</div>
                        <div>
                            <div class="text-sm font-semibold">{{ $post->user->name }}</div>
                            <div class="text-xs text-slate-400">{{ $post->created_at->diffForHumans() }} • {{ $post->title }}</div>
                        </div>
                    </div>
                    <p class="text-slate-700 whitespace-pre-line">{{ $post->content }}</p>
                    @if($post->media->count())
                        <div class="mt-4 grid grid-cols-2 gap-2">
                            @foreach($post->media->take(4) as $media)
                                @if($media->media_type === 'image')
                                    <img src="{{ asset('storage/'.$media->media_path) }}" class="rounded-xl object-cover h-40 w-full">
                                @else
                                    <video src="{{ asset('storage/'.$media->media_path) }}" class="rounded-xl h-40 w-full" controls muted></video>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-4 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                        <span>{{ $post->likes->count() }} likes • {{ $post->comments->count() }} comments</span>
                        @guest
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline"><i class="fa-solid fa-lock text-[10px]"></i> Sign in to like/comment</a>
                        @else
                            <span class="text-slate-400">View in <a href="{{ route('posts.index') }}" class="text-blue-600">full feed</a> to interact</span>
                        @endguest
                    </div>
                    {{-- Preview 2 comments --}}
                    @if($post->comments->count())
                        <div class="mt-3 space-y-2">
                            @foreach($post->comments->take(2) as $comment)
                                <div class="bg-[#F8FAFC] rounded-xl px-3 py-2">
                                    <span class="text-xs font-semibold">{{ $comment->user->name }}</span>
                                    <span class="text-sm text-slate-600"> {{ $comment->content }}</span>
                                </div>
                            @endforeach
                            @if($post->comments->count() > 2)
                                <div class="text-xs text-slate-400">+ {{ $post->comments->count() - 2 }} more • <a href="{{ route('login') }}" class="text-blue-600">Sign in</a> to see all</div>
                            @endif
                        </div>
                    @endif
                </article>
            @empty
                <div class="bg-white border border-dashed rounded-2xl p-12 text-center">
                    <p class="text-slate-600">No posts yet.</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="inline-block mt-4 px-5 py-2 bg-blue-600 text-white rounded-xl">Create First Post</a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
        <p class="mt-6 text-center text-xs text-slate-400">For full interaction (like, comment, delete) please use <a href="{{ route('posts.index') }}" class="underline">authenticated community</a> (requires Sign In).</p>
    </div>
</body>
</html>
