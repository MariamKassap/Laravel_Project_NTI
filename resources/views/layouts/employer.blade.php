<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Employer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Included Alpine.js for dropdown interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] font-sans text-slate-700 antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1E293B] text-slate-300 flex flex-col justify-between p-6 shrink-0">
            <div class="space-y-8">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center text-xl">J</div>
                    <span class="text-xl font-bold text-white tracking-tight">JobConnect</span>
                </div>

                <!-- Navigation -->
                <nav class="space-y-1">
                    <a href="{{ route('employer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('employer.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                        <i class="fa-solid fa-border-all"></i> Dashboard
                    </a>
                    <a href="{{ route('employer.jobs.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('employer.jobs.create') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                        <i class="fa-regular fa-circle-plus"></i> Post a Job
                    </a>
                    <a href="{{ route('employer.jobs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('employer.jobs.index') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                        <i class="fa-solid fa-bookmark"></i> Manage Jobs
                    </a>
                    <a href="{{ route('employer.jobs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('employer.jobs.applications.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                        <i class="fa-solid fa-user-group"></i> Applicants
                    </a>

                    <!-- Static UI Elements -->
                    <div class="pt-4 text-xs font-semibold text-slate-500 uppercase tracking-wider px-4">Menu</div>
                    <span class="flex items-center gap-3 px-4 py-2 text-slate-500 opacity-60 cursor-not-allowed">
                        <i class="fa-solid fa-building"></i> Company Profile
                    </span>
                    <span class="flex items-center gap-3 px-4 py-2 text-slate-500 opacity-60 cursor-not-allowed">
                        <i class="fa-solid fa-message"></i> Messages
                    </span>
                    <span class="flex items-center gap-3 px-4 py-2 text-slate-500 opacity-60 cursor-not-allowed">
                        <i class="fa-solid fa-gear"></i> Settings
                    </span>
                </nav>
            </div>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition w-full text-left font-medium">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-1 flex flex-col min-w-0">
            <!-- Top Navbar -->
            <header class="h-20 bg-white border-b border-slate-200 px-8 flex items-center justify-between">
                <h1 class="text-xl font-bold text-slate-800">@yield('page_title', 'Employer Portal')</h1>
                <div class="flex items-center gap-6">
                    <div class="relative w-72">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" placeholder="Search applicants, jobs..." class="w-full bg-slate-100 rounded-full pl-9 pr-4 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button class="text-slate-400 hover:text-slate-600"><i class="fa-regular fa-bell text-lg"></i></button>
                    
                    <!-- Interactive Profile Badge & Popover Square Card -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 border-l border-slate-200 pl-6 hover:opacity-80 transition focus:outline-none">
                            <div class="text-right">
                                <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-400">{{ ucfirst(auth()->user()->role ?? 'Employer') }}</div>
                            </div>
                            
                            @if(auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                            @else
                                <div class="w-10 h-10 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </button>

                        <!-- Floating Profile Modal Card -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 p-6 z-50 space-y-5" 
                             style="display: none;">
                            
                            <!-- User Details -->
                            <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                                @if(auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-blue-500 shadow-sm">
                                @else
                                    <div class="w-14 h-14 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-xl">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm">{{ auth()->user()->name }}</h4>
                                    <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 bg-blue-50 text-blue-600 font-semibold rounded-full text-[10px] uppercase tracking-wider">
                                        {{ auth()->user()->role ?? 'Employer' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Upload Image Form -->
                            <form method="POST" action="{{ route('employer.profile.image.update') }}" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Update Profile Image</label>
                                    <input type="file" name="image" accept="image/*" required class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                                </div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl text-xs transition shadow-sm">
                                    Upload Image
                                </button>
                            </form>

                            <!-- Read-Only Information -->
                            <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                                <div>
                                    <span class="text-slate-400 font-medium">Full Name:</span>
                                    <span class="text-slate-700 font-semibold block">{{ auth()->user()->name }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-medium">Email:</span>
                                    <span class="text-slate-700 font-semibold block">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Container -->
            <div class="p-8 flex-1 overflow-y-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>