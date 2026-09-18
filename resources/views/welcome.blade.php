<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Anti-عواطلي') }} — Bridge talent & opportunity</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-[#F4F0EA] text-black">

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
                    </h1>
                    <p class="mt-5 text-[15px] leading-6 font-normal text-black max-w-[580px] mx-auto lg:mx-0">
                        A hiring platform for the MENA & Global tech ecosystem.
                        Verified salaries, direct founder access, and zero recruiter gatekeeping.
                    </p>
                    <div class="mt-7 flex flex-wrap gap-3 justify-center lg:justify-start">
                        @auth
                            @if(auth()->user()->role === 'employee')
                                <a href="{{ route('employee.jobs.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Browse Jobs</a>
                            @elseif(auth()->user()->role === 'employer')
                                <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Browse Jobs</a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Browse Jobs</a>
                            @endif
                            <a href="{{ auth()->user()->role==='employer' ? route('employer.jobs.create') : route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-black hover:bg-[#EFECE6] text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Post a Job</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Browse Jobs</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-black hover:bg-[#EFECE6] text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Post a Job</a>
                        @endauth
                    </div>

                    {{-- Search Pill --}}
                    <div class="mt-9 max-w-[640px] mx-auto lg:mx-0">
                        <form action="{{ auth()->check() && auth()->user()->role==='employee' ? route('employee.jobs.index') : route('login') }}" method="GET" class="bg-white rounded-xl p-2 flex flex-col sm:flex-row gap-2 border-2 border-black shadow-[4px_4px_0px_0px_#000000] text-left">
                            <div class="flex-1 flex items-center gap-3 px-4 py-2.5 bg-[#E5E7EB] rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000]">
                                <i class="fa-solid fa-magnifying-glass text-black text-sm"></i>
                                <input type="text" name="search" placeholder="Role, title, or keyword..." class="w-full bg-transparent outline-none text-sm font-bold text-black placeholder:text-black/60" />
                            </div>
                            <div class="flex items-center gap-2 px-4 py-2.5 bg-[#E5E7EB] rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] sm:w-[220px] shrink-0">
                                <i class="fa-solid fa-location-dot text-black text-sm"></i>
                                <select name="location" class="w-full bg-transparent outline-none text-sm font-bold text-black">
                                    <option value="">Remote (Global/MENA)</option>
                                    <option value="Cairo">Cairo, Egypt</option>
                                    <option value="Riyadh">Riyadh, KSA</option>
                                    <option value="Dubai">Dubai, UAE</option>
                                    <option value="remote">Remote — Global</option>
                                </select>
                            </div>
                            <button type="submit" class="shrink-0 w-full sm:w-12 h-12 bg-[#2563EB] hover:bg-[#1D4ED8] text-white rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <div class="mt-3 flex flex-wrap gap-4 text-xs justify-center lg:justify-start">
                            <span class="inline-flex items-center gap-1.5 font-bold text-black"><i class="fa-solid fa-circle-check"></i> Verified Salaries Only</span>
                            <span class="inline-flex items-center gap-1.5 font-bold text-black"><i class="fa-solid fa-code"></i> Senior Engineering Focus</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= METRICS BANNER (REAL — without Community counter) ================= --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10">
            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] grid grid-cols-1 sm:grid-cols-3 divide-y-2 sm:divide-y-0 sm:divide-x-2 divide-black overflow-hidden">
                <div class="p-6 text-center sm:text-left">
                    <p class="text-2xl font-bold text-black tracking-tight">{{ number_format($activeJobsCount) }}</p>
                    <p class="text-sm font-bold text-black mt-1">Active Job Listings</p>
                    <p class="text-xs font-bold text-black mt-1.5">{{ $totalJobsCount }} total • @if($activeJobsCount) open now @else no open roles @endif</p>
                </div>
                <div class="p-6 text-center sm:text-left">
                    <p class="text-2xl font-bold text-black tracking-tight">{{ number_format($candidatesCount) }}</p>
                    <p class="text-sm font-bold text-black mt-1">Verified Candidates</p>
                    <p class="text-xs font-bold text-black mt-1.5">Registered employees</p>
                </div>
                <div class="p-6 text-center sm:text-left">
                    <p class="text-2xl font-bold text-black tracking-tight">@if(!is_null($placementRate)){{ $placementRate }}%@else —@endif</p>
                    <p class="text-sm font-bold text-black mt-1">Placement Success</p>
                    <p class="text-xs font-bold text-black mt-1.5">@if($totalApplications) {{ $totalApplications }} applications @else awaiting applications @endif</p>
                </div>
            </div>
        </section>

        {{-- ================= JOB OPPORTUNITIES (REAL) ================= --}}
        <section class="bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000] mt-14 mx-4 sm:mx-6 lg:mx-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl sm:text-[28px] font-bold tracking-tight text-black">High-Signal Tech Opportunities</h2>
                        <p class="text-sm font-bold text-black mt-1">Real open roles — sign in to apply.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-4 py-1.5 rounded-md text-sm font-bold bg-[#2563EB] text-white border-2 border-black shadow-[2px_2px_0px_0px_#000000]">{{ $totalJobsCount }} open</span>
                        <span class="px-4 py-1.5 rounded-md text-sm font-bold bg-white text-black border-2 border-black shadow-[2px_2px_0px_0px_#000000]">{{ $activeJobsCount }} active</span>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    @forelse($latestJobs as $job)
                        @php $initial = strtoupper(substr($job->employer->company ?? $job->employer->name ?? 'J',0,1)); @endphp
                        <div class="bg-white border-2 border-black rounded-xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center gap-4 shadow-[4px_4px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[6px_6px_0px_0px_#000000] transition-all">
                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                <span class="w-11 h-11 rounded-lg bg-[#2563EB] text-white font-bold flex items-center justify-center shrink-0 border-2 border-black shadow-[2px_2px_0px_0px_#000000]">{{ $initial }}</span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-[15px] font-bold tracking-tight text-black truncate">{{ $job->title }}</h3>
                                        <span class="hidden sm:inline w-1 h-1 bg-black rounded-full"></span>
                                        <span class="text-sm font-bold text-black truncate">{{ $job->employer->company ?? $job->employer->name }} • {{ $job->location ?? 'Remote' }}</span>
                                    </div>
                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                        @if($job->salary)
                                            <span class="inline-flex text-xs font-bold bg-[#FEF08A] text-black px-2.5 py-1 rounded-md border-2 border-black shadow-[2px_2px_0px_0px_#000000]">${{ number_format($job->salary) }}</span>
                                        @endif
                                        <span class="text-xs font-bold bg-[#BFDBFE] text-black px-2.5 py-1 rounded-md border-2 border-black shadow-[2px_2px_0px_0px_#000000]">{{ ucfirst(str_replace('_',' ', $job->job_type ?? 'Full-time')) }}</span>
                                        <span class="text-xs font-bold text-black">Posted {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 self-end sm:self-auto">
                                @guest
                                    <a href="{{ route('login') }}" title="Sign in to save" class="w-9 h-9 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-regular fa-bookmark text-sm"></i></a>
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">Sign in to Apply</a>
                                @else
                                    @if(auth()->user()->role === 'employee')
                                        <a href="{{ route('employee.job.show', $job) }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">View & Apply</a>
                                    @else
                                        <a href="{{ route('employer.jobs.show', $job) }}" class="inline-flex items-center px-5 py-2.5 bg-white text-black hover:bg-[#EFECE6] text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">View</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border-2 border-black rounded-xl p-10 text-center shadow-[4px_4px_0px_0px_#000000]">
                            <p class="text-sm font-bold tracking-tight text-black">No verified tech positions yet</p>
                            <p class="text-sm font-bold text-black mt-1">New roles from real employers will appear here.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8 text-center">
                    @auth
                        @if(auth()->user()->role==='employee')
                            <a href="{{ route('employee.jobs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-black hover:text-black">View All {{ $totalJobsCount }} Verified Tech Positions <i class="fa-solid fa-arrow-right text-xs"></i></a>
                        @else
                            <a href="{{ route('employer.jobs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-black hover:text-black">Manage {{ $totalJobsCount }} Positions <i class="fa-solid fa-arrow-right text-xs"></i></a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-bold text-black hover:text-black">Sign in to view all {{ $totalJobsCount }} positions <i class="fa-solid fa-arrow-right text-xs"></i></a>
                    @endauth
                </div>
            </div>
        </section>

        {{-- ================= DUAL VALUE PROP ================= --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <h2 class="text-center text-2xl sm:text-[28px] font-bold tracking-tight text-black">Direct Connections. Zero Gatekeepers.</h2>
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Candidate --}}
                <div class="bg-white rounded-xl border-2 border-black p-7 sm:p-8 flex flex-col shadow-[4px_4px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[6px_6px_0px_0px_#000000] transition-all">
                    <p class="text-[11px] font-bold tracking-[0.14em] text-black">FOR CANDIDATES</p>
                    <h3 class="mt-2 text-xl font-bold tracking-tight text-black">Stop Waiting on Cold Resumes</h3>
                    <p class="mt-2 text-sm font-bold text-black leading-6">Show your real work. Get discovered through skills, not keywords.</p>
                    <ul class="mt-6 space-y-3 text-sm font-bold text-black">
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Verified salary ranges on every role</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Direct chat with hiring managers</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Reputation that follows you</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Weekly curated high-signal drops</li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all w-fit">Create Candidate Profile</a>
                </div>
                {{-- Employer --}}
                <div class="bg-[#FEF08A] rounded-xl border-2 border-black p-7 sm:p-8 flex flex-col shadow-[4px_4px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[6px_6px_0px_0px_#000000] transition-all">
                    <div>
                        <p class="text-[11px] font-bold tracking-[0.14em] text-black">FOR EMPLOYERS</p>
                        <h3 class="mt-2 text-xl font-bold tracking-tight text-black">Hire Vetted Engineers Fast</h3>
                        <p class="mt-2 text-sm font-bold text-black leading-6">Skip the agency tax. Reach an active talent pool.</p>
                        <ul class="mt-6 space-y-3 text-sm font-bold text-black">
                            <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> @if(!is_null($placementRate)) {{ $placementRate }}% placement @else Awaiting placements @endif</li>
                            <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> {{ $candidatesCount }} verified candidates</li>
                            <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Direct access to talent</li>
                            <li class="flex gap-3"><i class="fa-solid fa-circle-check text-black mt-0.5"></i> Fixed pricing — no contingency</li>
                        </ul>
                        <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-5 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-bold rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all w-fit">Post a Job Now — $149</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-white border-t-2 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                        <span class="w-9 h-9 bg-[#2563EB] text-white font-extrabold rounded-lg flex items-center justify-center text-[15px] border-2 border-black shadow-[2px_2px_0px_0px_#000000]">A</span>
                        <span class="text-[17px] font-bold tracking-tight text-black">Anti-عواطلي</span>
                    </a>
                    <p class="mt-3 text-sm font-bold text-black leading-6 max-w-xs">
                        The direct hiring network for MENA & Global tech talent. Verified roles, zero gatekeepers.
                    </p>
                    <div class="mt-4 flex gap-3">
                        <a href="#" class="w-8 h-8 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-brands fa-linkedin-in text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white border-2 border-black shadow-[2px_2px_0px_0px_#000000] text-black hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center"><i class="fa-brands fa-github text-sm"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-bold tracking-tight text-black">Explore</h4>
                    <ul class="mt-4 space-y-2.5 text-sm font-bold text-black">
                        <li><a href="{{ auth()->check() && auth()->user()->role==='employee' ? route('employee.jobs.index') : route('login') }}" class="hover:text-black">Browse Jobs</a></li>
                        <li><a href="#" class="hover:text-black">Companies</a></li>
                        <li><a href="#" class="hover:text-black">Salaries</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold tracking-tight text-black">Resources</h4>
                    <ul class="mt-4 space-y-2.5 text-sm font-bold text-black">
                        <li><a href="#" class="hover:text-black">Career Advice</a></li>
                        <li><a href="#" class="hover:text-black">Hiring Guide</a></li>
                        <li><a href="#" class="hover:text-black">Engineering Blog</a></li>
                        <li><a href="#" class="hover:text-black">Help Center</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold tracking-tight text-black">Company</h4>
                    <ul class="mt-4 space-y-2.5 text-sm font-bold text-black">
                        <li><a href="#" class="hover:text-black">About</a></li>
                        <li><a href="#" class="hover:text-black">Pricing</a></li>
                        <li><a href="#" class="hover:text-black">Contact</a></li>
                        <li><a href="#" class="hover:text-black">Privacy & Terms</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t-2 border-black flex flex-col sm:flex-row gap-3 justify-between items-center text-xs font-bold text-black">
                <p>© {{ date('Y') }} Anti-عواطلي. All rights reserved. Built for the makers.</p>
                <p class="inline-flex items-center gap-2"><span class="w-2 h-2 bg-[#2563EB] rounded-full border border-black"></span> All systems operational</p>
            </div>
        </div>
    </footer>

</body>
</html>
