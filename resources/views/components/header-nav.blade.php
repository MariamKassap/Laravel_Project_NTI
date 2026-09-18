{{-- Unified top header — Neo-Brutalist — replaces sidebar --}}
@php
$user = auth()->user();
$role = $user?->role;
$homeRoute = match($role) {
'employee' => route('employee.dashboard'),
'employer' => route('employer.dashboard'),
'admin' => Route::has('admin.dashboard') ? route('admin.dashboard') : url('/'),
default => url('/'),
};
@endphp
<nav class="bg-white border-b-2 border-black sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">
            {{-- Far Left: Logo --}}
            <a href="{{ $homeRoute }}" class="flex items-center gap-2.5 shrink-0">
                <span class="w-9 h-9 bg-[#2563EB] text-white font-black rounded-lg flex items-center justify-center text-[15px] tracking-tight border-2 border-black shadow-[2px_2px_0px_0px_#000000]">A</span>
                <span class="text-[17px] font-black tracking-tight text-black">Anti-عواطلي</span>
            </a>

            {{-- Center: Text Links (hidden on mobile) --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ $homeRoute }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employee.dashboard') || request()->routeIs('employer.dashboard') || request()->routeIs('admin.dashboard') ? 'underline' : '' }}">Home</a>

                @if($role === 'employee')
                <a href="{{ route('employee.jobs.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employee.jobs.*') ? 'underline' : '' }}">Jobs</a>
                <a href="{{ route('employee.applications.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employee.applications.*') ? 'underline' : '' }}">Applications</a>
                @elseif($role === 'employer')
                <a href="{{ route('employer.jobs.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employer.jobs.*') ? 'underline' : '' }}">Jobs</a>
                <a href="{{ route('employer.applications.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employer.applications.*') || request()->routeIs('employer.jobs.applications.*') ? 'underline' : '' }}">Applications</a>
                <!-- <a href="{{ route('employer.jobs.create') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('employer.jobs.create') ? 'underline' : '' }}">Post</a> -->
                @else
                <a href="{{ route('employee.jobs.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2">Jobs</a>
                <a href="{{ route('employee.applications.index') }}" class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2">Applications</a>
                @endif
                <a href="{{ route('posts.index') }}"
                    class="px-3 py-2 text-sm font-bold text-black hover:underline underline-offset-4 decoration-2 {{ request()->routeIs('posts.*') ? 'underline' : '' }}">
                    Posts
                </a>
            </div>

            {{-- Far Right: Search + Bell + Profile Dropdown --}}
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <!-- <div class="hidden sm:flex relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-black text-xs"></i>
                    <input type="text" placeholder="Search..." class="w-44 lg:w-56 bg-white border-2 border-black rounded-lg pl-8 pr-3 py-1.5 text-sm font-bold text-black placeholder:text-black/50 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 focus:border-black">
                </div> -->

                {{-- Notifications — single bell --}}
                <!-- <button class="w-9 h-9 bg-white border-2 border-black rounded-lg flex items-center justify-center text-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all" title="Notifications">
                    <i class="fa-regular fa-bell text-sm"></i>
                </button> -->

                {{-- Profile Dropdown --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center gap-2">
                        @if($user && $user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                        @else
                        <span class="w-9 h-9 bg-[#2563EB] text-white font-black rounded-full flex items-center justify-center text-sm border-2 border-black shadow-[2px_2px_0px_0px_#000000]">{{ strtoupper(substr($user->name ?? 'U',0,1)) }}</span>
                        @endif
                        <i class="fa-solid fa-chevron-down text-[10px] text-black hidden sm:block"></i>
                    </button>
                    <div x-show="open" x-transition class="absolute right-0 mt-3 w-56 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] overflow-hidden z-50" style="display:none;">
                        <div class="px-4 py-3 border-b-2 border-black bg-[#F4F0EA]">
                            <p class="text-sm font-black text-black truncate">{{ $user->name ?? 'User' }}</p>
                            <p class="text-xs font-bold text-black truncate">{{ $user->email ?? '' }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-bold text-black hover:bg-[#EFECE6]">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-bold text-black hover:bg-[#EFECE6]">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Mobile menu toggle --}}
                <button class="md:hidden w-9 h-9 bg-white border-2 border-black rounded-lg flex items-center justify-center shadow-[2px_2px_0px_0px_#000000]" @click="document.getElementById('mobile-header-nav').classList.toggle('hidden')" title="Menu">
                    <i class="fa-solid fa-bars text-sm text-black"></i>
                </button>
            </div>
        </div>
    </div>
    {{-- Mobile nav --}}
    <div id="mobile-header-nav" class="hidden md:hidden border-t-2 border-black bg-[#F4F0EA]">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ $homeRoute }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Home</a>
            @if($role === 'employee')
            <a href="{{ route('employee.jobs.index') }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Jobs</a>
            <a href="{{ route('employee.applications.index') }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Applications</a>
            @elseif($role === 'employer')
            <a href="{{ route('employer.jobs.index') }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Jobs</a>
            <a href="{{ route('employer.jobs.create') }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Post</a>
            @endif
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm font-bold text-black hover:bg-white border-2 border-transparent hover:border-black rounded-lg">Profile</a>
        </div>
    </div>
</nav>