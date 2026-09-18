<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anti-عواطلي - {{ $title ?? 'Employer Home' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F4F0EA] font-sans text-black antialiased">
    <div class="min-h-screen bg-[#F4F0EA] flex flex-col">
        <x-header-nav />

        <!-- Main Content Container -->
        <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-300 border-2 border-black text-black font-bold rounded-xl flex items-center gap-3 shadow-[4px_4px_0px_0px_#000000]">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>

</html>
