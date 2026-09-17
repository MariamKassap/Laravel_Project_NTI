<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $job->title }} - {{ config('app.name', 'JobConnect') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-700">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 text-white font-bold rounded-lg flex items-center justify-center">J</div>
                    <span class="font-bold text-slate-800">JobConnect</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('public.jobs.index') }}" class="text-sm text-slate-600">All Jobs</a>
                    <a href="{{ route('public.posts.index') }}" class="text-sm text-slate-600">Community</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium">Sign In</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-xl">Register</a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="text-sm">{{ auth()->user()->name }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('public.jobs.index') }}" class="text-sm text-slate-500 hover:text-slate-700"><i class="fa-solid fa-arrow-left text-xs"></i> Back to Jobs</a>

        <div class="bg-white border border-slate-100 rounded-2xl p-8 mt-6 shadow-sm">
            <h1 class="text-3xl font-bold text-slate-900">{{ $job->title }}</h1>
            <p class="text-slate-500 mt-2">
                <i class="fa-solid fa-building text-xs"></i> {{ $job->employer->company ?? $job->employer->name }}
                @if($job->location) • <i class="fa-solid fa-location-dot text-xs"></i> {{ $job->location }} @endif
            </p>

            {{-- Company card (uses existing users.company string) --}}
            <div class="mt-6 bg-[#F8FAFC] border border-slate-100 rounded-xl p-4 flex gap-4">
                <div class="w-12 h-12 bg-white border rounded-xl flex items-center justify-center font-bold text-slate-600">
                    {{ strtoupper(substr($job->employer->company ?? $job->employer->name, 0,1)) }}
                </div>
                <div>
                    <div class="text-sm font-semibold text-slate-800">{{ $job->employer->company ?? $job->employer->name }}</div>
                    <div class="text-xs text-slate-500">Employer • Member since {{ $job->employer->created_at->format('M Y') }}</div>
                    <div class="text-xs text-slate-400 mt-1">{{ $job->employer->email }}</div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-2">
                @if($job->job_type)<span class="px-3 py-1 bg-slate-100 rounded-full text-xs font-semibold">{{ ucfirst(str_replace('_',' ', $job->job_type)) }}</span>@endif
                @if($job->salary)<span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold">{{ number_format($job->salary) }} EGP</span>@endif
                @if($job->deadline)<span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs">Deadline {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>@endif
            </div>

            <div class="mt-8">
                <h3 class="font-semibold text-slate-800">Job Description</h3>
                <p class="text-slate-600 mt-3 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
            </div>

            <div class="mt-8 flex gap-3">
                @guest
                    <a href="{{ route('login') }}" class="flex-1 text-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl">Sign in to Apply</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 border border-slate-200 rounded-xl font-semibold">Create Account</a>
                @else
                    @if(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.jobs.apply', $job) }}" class="flex-1 text-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl">Apply for this Job</a>
                    @elseif(auth()->user()->role === 'employer' || auth()->user()->role === 'admin')
                        <div class="flex-1 px-6 py-3 bg-slate-100 text-slate-500 rounded-xl text-center text-sm font-medium">Employers cannot apply</div>
                    @endif
                @endguest
            </div>
            <p class="text-xs text-slate-400 mt-4 text-center"><i class="fa-solid fa-lock text-[10px]"></i> Applying, like/comment require authentication.</p>
        </div>
    </div>
</body>
</html>
