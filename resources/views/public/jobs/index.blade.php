<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jobs - {{ config('app.name', 'JobConnect') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-700">
    {{-- Public Navbar --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center">J</div>
                        <span class="text-lg font-bold text-slate-800">JobConnect</span>
                    </a>
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('public.jobs.index') }}" class="text-sm font-medium text-blue-600">Jobs</a>
                        <a href="{{ route('public.posts.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Community</a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 px-4 py-2">Sign In</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl">Register</a>
                    @else
                        @if(auth()->user()->role === 'employee')
                            <a href="{{ route('employee.dashboard') }}" class="text-sm font-medium text-slate-600">Dashboard</a>
                        @elseif(auth()->user()->role === 'employer')
                            <a href="{{ route('employer.dashboard') }}" class="text-sm font-medium text-slate-600">Dashboard</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-blue-100 text-blue-700 font-bold rounded-full flex items-center justify-center text-sm">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Browse Jobs</h1>
            <p class="text-slate-500 mt-2">Public listing - sign in to apply. Newest first.</p>
        </div>

        {{-- Search - public, reuses JobController search --}}
        <form method="GET" action="{{ route('public.jobs.index') }}" class="mb-8 flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title, location, company..." class="flex-1 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">
            <select name="job_type" class="rounded-xl border-slate-200">
                <option value="">All Types</option>
                <option value="full_time" {{ request('job_type')==='full_time'?'selected':'' }}>Full Time</option>
                <option value="part_time" {{ request('job_type')==='part_time'?'selected':'' }}>Part Time</option>
                <option value="internship" {{ request('job_type')==='internship'?'selected':'' }}>Internship</option>
                <option value="contract" {{ request('job_type')==='contract'?'selected':'' }}>Contract</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-semibold">Search</button>
            @if(request('search') || request('job_type'))
                <a href="{{ route('public.jobs.index') }}" class="px-4 py-2 border border-slate-200 rounded-xl text-sm">Clear</a>
            @endif
        </form>

        @if($jobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition flex flex-col">
                        <h3 class="font-bold text-slate-800 line-clamp-1">{{ $job->title }}</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ $job->employer->company ?? $job->employer->name }} @if($job->location) • {{ $job->location }} @endif</p>
                        <div class="mt-3 flex gap-2">
                            @if($job->job_type)<span class="text-xs bg-slate-100 px-2 py-1 rounded-full">{{ ucfirst(str_replace('_',' ', $job->job_type)) }}</span>@endif
                            @if($job->salary)<span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full">{{ number_format($job->salary) }} EGP</span>@endif
                        </div>
                        <p class="text-sm text-slate-600 mt-4 line-clamp-3">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('public.jobs.show', $job) }}" class="flex-1 text-center px-4 py-2 bg-slate-900 text-white text-sm font-semibold rounded-xl">View</a>
                            @guest
                                <a href="{{ route('login') }}" class="px-4 py-2 border border-slate-200 rounded-xl text-sm">Sign in to Apply</a>
                            @else
                                @if(auth()->user()->role === 'employee')
                                    <a href="{{ route('employee.jobs.apply', $job) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl">Apply</a>
                                @endif
                            @endguest
                        </div>
                        <p class="text-xs text-slate-400 mt-3">{{ $job->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $jobs->links() }}</div>
        @else
            <div class="bg-white border border-dashed rounded-2xl p-12 text-center">
                <p class="text-slate-600">No jobs match your search.</p>
            </div>
        @endif
    </div>
</body>
</html>
