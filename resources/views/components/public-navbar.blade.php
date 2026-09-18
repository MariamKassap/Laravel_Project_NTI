{{-- Public navbar — Neo-Brutalist --}}
<nav class="bg-white border-b-2 border-black sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 gap-4">
            {{-- Brand --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
                <span class="w-9 h-9 bg-[#2563EB] text-white font-extrabold rounded-lg flex items-center justify-center text-[15px] tracking-tight border-2 border-black shadow-[2px_2px_0px_0px_#000000]">A</span>
                <span class="text-[17px] font-bold text-black tracking-tight">Anti-عواطلي</span>
            </a>

            {{-- Right — Log in / Sign Up or Dashboard --}}
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-bold text-black hover:text-black px-4 py-2">Log in</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Sign Up</a>
                @else
                    @if(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="hidden sm:inline-flex text-sm font-bold text-black hover:text-black px-3 py-2">Dashboard</a>
                    @elseif(auth()->user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" class="hidden sm:inline-flex text-sm font-bold text-black hover:text-black px-3 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="hidden sm:inline-flex text-sm font-bold text-black hover:text-black px-3 py-2">Dashboard</a>
                    @endif
                    <div class="flex items-center gap-3 border-l-2 border-black pl-4">
                        <span class="hidden sm:block text-sm font-bold text-black">{{ auth()->user()->name }}</span>
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-white text-black font-bold rounded-full flex items-center justify-center text-sm shrink-0 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-black hover:text-black text-sm ml-1 font-bold" title="Log out"><i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
