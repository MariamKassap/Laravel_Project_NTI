{{-- Shared public navbar - used on welcome, public jobs, public community to prevent layout shift --}}
<nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <div class="w-8 h-8 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center">J</div>
                    <span class="text-lg font-bold text-slate-800 tracking-tight">JobConnect</span>
                </a>
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('public.jobs.index') }}" class="text-sm font-medium {{ request()->routeIs('public.jobs.*') ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }}">Jobs</a>
                    <a href="{{ route('public.posts.index') }}" class="text-sm font-medium {{ request()->routeIs('public.posts.*') || request()->routeIs('posts.*') ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }}">Community</a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-4 py-2">Sign In</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">Register</a>
                @else
                    @if(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                    @elseif(auth()->user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('profile.edit') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Dashboard</a>
                    @endif
                    <a href="{{ route('public.jobs.index') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Jobs</a>
                    <a href="{{ route('public.posts.index') }}" class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Community</a>
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4">
                        <span class="hidden sm:block text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-sm shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-slate-600 text-sm ml-1" title="Log out"><i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    {{-- Mobile links - identical on all public pages to avoid height shift --}}
    <div class="sm:hidden border-t border-slate-100 px-4 py-3 flex gap-4">
        <a href="{{ route('public.jobs.index') }}" class="text-sm font-medium {{ request()->routeIs('public.jobs.*') ? 'text-blue-600' : 'text-slate-600' }}">Jobs</a>
        <a href="{{ route('public.posts.index') }}" class="text-sm font-medium {{ request()->routeIs('public.posts.*') || request()->routeIs('posts.*') ? 'text-blue-600' : 'text-slate-600' }}">Community</a>
        @auth
            @if(auth()->user()->role === 'employee')
                <a href="{{ route('employee.dashboard') }}" class="text-sm font-medium text-blue-600 ml-auto">My Dashboard</a>
            @elseif(auth()->user()->role === 'employer')
                <a href="{{ route('employer.dashboard') }}" class="text-sm font-medium text-blue-600 ml-auto">My Dashboard</a>
            @endif
        @endauth
    </div>
</nav>
