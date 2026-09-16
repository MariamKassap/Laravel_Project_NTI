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

                    <button class="text-slate-400 hover:text-slate-600">
                        <i class="fa-regular fa-bell text-lg"></i>
                    </button>

                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 border-l border-slate-200 pl-6 hover:opacity-80 transition">

                        <div class="text-right">
                            <div class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name }}
                            </div>

                            <div class="text-xs text-slate-400">
                                {{ ucfirst(auth()->user()->role ?? 'Employer') }}
                            </div>
                        </div>

                        @if(auth()->user()->image)
                        <img
                            src="{{ asset('storage/' . auth()->user()->image) }}"
                            alt="{{ auth()->user()->name }}"
                            class="w-10 h-10 rounded-full object-cover border border-slate-200">
                        @else
                        <div class="w-10 h-10 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        @endif

                    </a>
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