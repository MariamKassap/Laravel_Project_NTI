<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'JobConnect') }} - Find Your Next Opportunity</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-800">
    {{-- Public Navbar - guest-safe --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center">J</div>
                        <span class="text-lg font-bold text-slate-800 tracking-tight">JobConnect</span>
                    </a>

                    {{-- Public Links --}}
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('public.jobs.index') }}" class="text-sm font-medium {{ request()->routeIs('public.jobs.*') ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }}">Jobs</a>
                        <a href="{{ route('public.posts.index') }}" class="text-sm font-medium {{ request()->routeIs('public.posts.*') || request()->routeIs('posts.*') ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }}">Community</a>
                    </div>
                </div>

<<<<<<< Updated upstream
                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-4 py-2">Sign In</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">Register</a>
                    @else
                        {{-- Authenticated - role-aware dashboard link --}}
=======
    <x-public-navbar />

    <main>
        {{-- ================= HERO — focused on core value (no community widget) ================= --}}
        <section class="bg-[#F4F0EA] relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20 relative">
                <div class="max-w-3xl mx-auto text-center lg:text-left lg:mx-0">
                    <span class="inline-flex items-center gap-2 text-[11px] font-bold tracking-[0.14em] text-black bg-white border-2 border-black rounded-full px-3.5 py-1.5 shadow-[2px_2px_0px_0px_#000000]">
                        <span class="w-1.5 h-1.5 bg-[#2563EB] rounded-full border border-black"></span>
                        DIRECT. NO MATCHING ALGORITHMS.
                    </span>
                    <h1 class="mt-6 text-[32px] sm:text-[40px] lg:text-[48px] font-bold leading-[1.05] tracking-tight text-black">
                        Bridge the gap between<br>
                        <span class="text-black">talent and opportunity.</span><br>
                        <span class="text-black font-bold">No fluff, just real tech careers.</span>
                    
                    <div class="mt-7 flex flex-wrap gap-3 justify-center lg:justify-start">
                        @auth
>>>>>>> Stashed changes
                        @if(auth()->user()->role === 'employee')
                            <a href="{{ route('employee.dashboard') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                        @elseif(auth()->user()->role === 'employer')
                            <a href="{{ route('employer.dashboard') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="{{ route('profile.edit') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                        @endif
                        <a href="{{ route('public.jobs.index') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Jobs</a>
                        <a href="{{ route('public.posts.index') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Community</a>

                        {{-- Profile dropdown simple --}}
                        <div class="flex items-center gap-3 border-l border-slate-200 pl-4">
                            <span class="hidden sm:block text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                            <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-slate-400 hover:text-slate-600 text-sm ml-1"><i class="fa-solid fa-right-from-bracket"></i></button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
        {{-- Mobile links --}}
        <div class="sm:hidden border-t border-slate-100 px-4 py-3 flex gap-4">
            <a href="{{ route('public.jobs.index') }}" class="text-sm font-medium text-slate-600">Jobs</a>
            <a href="{{ route('public.posts.index') }}" class="text-sm font-medium text-slate-600">Community</a>
            @auth
                @if(auth()->user()->role === 'employee')
                    <a href="{{ route('employee.dashboard') }}" class="text-sm font-medium text-blue-600">My Dashboard</a>
                @elseif(auth()->user()->role === 'employer')
                    <a href="{{ route('employer.dashboard') }}" class="text-sm font-medium text-blue-600">My Dashboard</a>
                @endif
            @endauth
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-[#1E293B] to-[#0F172A] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="inline-flex items-center gap-2 text-xs font-semibold tracking-wider uppercase bg-white/10 border border-white/10 rounded-full px-3 py-1 mb-4">
                        <i class="fa-solid fa-sparkles text-blue-400"></i> Public Community & Job Board
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-bold leading-tight">
                        Discover Opportunities.<br>
                        <span class="text-blue-400">Connect</span> with Your Community.
                    </h1>
                    <p class="mt-4 text-slate-300 text-lg leading-relaxed max-w-xl">
                        Browse jobs posted by top employers and explore posts from professionals. Sign in to apply, comment, and like - your next opportunity is one click away.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('public.jobs.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition">
                            <i class="fa-solid fa-briefcase"></i> Browse Jobs
                            @if(isset($jobs))<span class="bg-white/20 rounded-full px-2 py-0.5 text-xs">{{ $jobs->count() }} new</span>@endif
                        </a>
                        <a href="{{ route('public.posts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-slate-900 font-semibold rounded-xl hover:bg-slate-100 transition">
                            <i class="fa-solid fa-comments"></i> Explore Community
                        </a>
                    </div>
                    @guest
                        <p class="mt-4 text-sm text-slate-400">New here? <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium">Create account</a> or <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Sign In</a> to apply and interact.</p>
                    @endguest
                </div>
                <div class="hidden lg:block">
                    <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 space-y-4">
                        <div class="flex items-center gap-3 text-slate-200">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center"><i class="fa-solid fa-building"></i></div>
                            <div>
                                <div class="text-sm font-semibold">Employers are hiring</div>
                                <div class="text-xs text-slate-400">{{ isset($jobs) ? $jobs->count() : 0 }} recent openings • Updated daily</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-slate-200">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <div class="text-sm font-semibold">Community is active</div>
                                <div class="text-xs text-slate-400">{{ isset($posts) ? $posts->count() : 0 }} recent posts • Join discussion</div>
                            </div>
<<<<<<< Updated upstream
                        </div>
                        <div class="pt-2 text-xs text-slate-400">
                            <i class="fa-solid fa-lock text-[10px]"></i> Apply, like, comment, and create posts require authentication. Browsing is public.
=======
                            <button type="submit" class="shrink-0 w-full sm:w-12 h-12 bg-[#2563EB] hover:bg-[#1D4ED8] text-white rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <div class="mt-3 flex flex-wrap gap-4 text-xs justify-center lg:justify-start">
                            <span class="inline-flex items-center gap-1.5 font-bold text-black"><i class="fa-solid fa-circle-check"></i> Verified Salaries Only</span>
                            
>>>>>>> Stashed changes
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Jobs Section --}}
    <section id="jobs" class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Latest Jobs</h2>
                    <p class="mt-2 text-slate-500">Opportunities posted by employers - public browsing, apply after sign in.</p>
                </div>
                <a href="{{ route('public.jobs.index') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Browse all Jobs <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            @if(isset($jobs) && $jobs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jobs as $job)
                        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition flex flex-col">
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-800 line-clamp-1">{{ $job->title }}</h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    <i class="fa-solid fa-building text-[11px]"></i> {{ $job->employer->company ?? $job->employer->name }}
                                    @if($job->location) • {{ $job->location }} @endif
                                </p>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @if($job->job_type)
                                        <span class="text-[11px] font-semibold px-2 py-1 bg-slate-100 text-slate-600 rounded-full">{{ ucfirst(str_replace('_',' ', $job->job_type)) }}</span>
                                    @endif
                                    @if($job->salary)
                                        <span class="text-[11px] font-semibold px-2 py-1 bg-emerald-50 text-emerald-700 rounded-full">{{ number_format($job->salary) }} EGP</span>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-600 mt-4 line-clamp-3">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                            </div>
                            <div class="mt-6 flex gap-2">
                                <a href="{{ route('public.jobs.show', $job) }}" class="flex-1 text-center px-4 py-2 bg-slate-900 text-white text-sm font-semibold rounded-xl hover:bg-slate-800 transition">View Details</a>
                                @auth
                                    @if(auth()->user()->role === 'employee')
                                        <a href="{{ route('employee.jobs.apply', $job) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">Apply</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 border border-slate-200 text-slate-600 text-sm font-semibold rounded-xl hover:bg-slate-50">Sign in to Apply</a>
                                @endauth
                            </div>
                            <p class="text-[11px] text-slate-400 mt-3">Posted {{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 text-center sm:hidden">
                    <a href="{{ route('public.jobs.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 font-semibold rounded-xl">Browse all Jobs <i class="fa-solid fa-arrow-right text-xs"></i></a>
                </div>
            @else
                <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mx-auto"><i class="fa-solid fa-briefcase text-slate-400"></i></div>
                    <p class="mt-4 text-slate-600 font-medium">No jobs posted yet.</p>
                    <p class="text-sm text-slate-400 mt-1">Employers will post opportunities here - check back soon.</p>
                    @auth
                        @if(auth()->user()->role === 'employer')
                            <a href="{{ route('employer.jobs.create') }}" class="inline-flex mt-4 px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl">Post a Job</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </section>

    {{-- Community Section --}}
    <section id="community" class="py-12 sm:py-16 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Community Feed</h2>
                    <p class="mt-2 text-slate-500">Public posts preview - sign in to like, comment, or create.</p>
                </div>
                <a href="{{ route('public.posts.index') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Explore Community <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

<<<<<<< Updated upstream
            @if(isset($posts) && $posts->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-[#F8FAFC] border border-slate-100 rounded-2xl p-6 flex flex-col">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-sm">{{ strtoupper(substr($post->user->name,0,1)) }}</div>
                                <div class="min-w-0">
                                    <div class="text-sm font-semibold text-slate-800 truncate">{{ $post->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $post->created_at?->diffForHumans() }}</div>
                                </div>
                            </div>
                            <h3 class="font-bold text-slate-800 line-clamp-2">{{ $post->title }}</h3>
                            <p class="text-sm text-slate-600 mt-2 line-clamp-3">{{ \Illuminate\Support\Str::limit($post->content, 140) }}</p>
                            @if($post->media->count())
                                <div class="mt-3 flex items-center gap-2 text-xs text-slate-500">
                                    <i class="fa-solid fa-photo-film"></i> {{ $post->media->count() }} media • {{ $post->likes->count() }} likes • {{ $post->comments->count() }} comments
                                </div>
                            @else
                                <div class="mt-3 text-xs text-slate-500">{{ $post->likes->count() }} likes • {{ $post->comments->count() }} comments</div>
                            @endif
                            <div class="mt-6 flex gap-2">
                                <a href="{{ route('public.posts.index') }}" class="flex-1 text-center px-4 py-2 bg-slate-900 text-white text-sm font-semibold rounded-xl hover:bg-slate-800">View Post</a>
                                @guest
                                    <a href="{{ route('login') }}" class="px-3 py-2 border border-slate-200 text-slate-500 text-xs font-semibold rounded-xl hover:bg-white">Sign in to interact</a>
                                @endguest
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8 text-center sm:hidden">
                    <a href="{{ route('public.posts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl">Explore Community <i class="fa-solid fa-arrow-right text-xs"></i></a>
                </div>
            @else
                <div class="bg-[#F8FAFC] border border-dashed border-slate-200 rounded-2xl p-12 text-center">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mx-auto"><i class="fa-solid fa-comments text-slate-400"></i></div>
                    <p class="mt-4 text-slate-600 font-medium">No posts yet.</p>
                    <p class="text-sm text-slate-400 mt-1">Be the first to share with the community.</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="inline-flex mt-4 px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl">Create Post</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex mt-4 px-5 py-2 border border-slate-200 text-slate-600 text-sm font-semibold rounded-xl">Sign in to Post</a>
                    @endauth
                </div>
            @endif
            <p class="mt-6 text-center text-xs text-slate-400"><i class="fa-solid fa-lock text-[10px]"></i> Creating posts, liking, and commenting require <a href="{{ route('login') }}" class="underline">authentication</a>. Browsing is public.</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between gap-4 text-sm text-slate-500">
            <div>&copy; {{ date('Y') }} JobConnect. Public browsing enabled — protected actions require Sign In.</div>
            <div class="flex gap-4">
                <a href="{{ route('public.jobs.index') }}" class="hover:text-slate-700">Jobs</a>
                <a href="{{ route('public.posts.index') }}" class="hover:text-slate-700">Community</a>
                @guest
                    <a href="{{ route('login') }}" class="hover:text-slate-700">Sign In</a>
                    <a href="{{ route('register') }}" class="hover:text-slate-700">Register</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="hover:text-slate-700">Profile</a>
                @endguest
=======
    {{-- ================= FOOTER ================= --}}
    <footer class="bg-white border-t-2 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                        <span class="w-9 h-9 bg-[#2563EB] text-white font-extrabold rounded-lg flex items-center justify-center text-[15px] border-2 border-black shadow-[2px_2px_0px_0px_#000000]">A</span>
                        <span class="text-[17px] font-bold tracking-tight text-black">Anti-عواطلي</span>
                    </a>
                    
                    <div class="mt-4 flex gap-3">
                        
                        <a href="https://www.linkedin.com/in/salma-fathy-elshafei-8b7a8a24a/" class="w-8 h-8 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-brands fa-linkedin-in text-sm"></i></a>
                        <a href="https://github.com/salma150" class="w-8 h-8 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-brands fa-github text-sm"></i></a>
                        
                    </div>
                    </div>
                </div>
                
            <div class="mt-10 pt-6 border-t-2 border-black flex flex-col sm:flex-row gap-3 justify-between items-center text-xs font-bold text-black">
                <p>© {{ date('Y') }} Anti-عواطلي. All rights reserved. Built for the makers.</p>
                <p class="inline-flex items-center gap-2"><span class="w-2 h-2 bg-[#2563EB] rounded-full border border-black"></span> All systems operational</p>
>>>>>>> Stashed changes
            </div>
        </div>
    </footer>
</body>
</html>
