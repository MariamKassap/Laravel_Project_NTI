<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anti-عواطلي - {{ $title ?? 'Tech Careers' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-black antialiased bg-[#F4F0EA]">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F4F0EA]">

        <div class="mb-4 flex items-center gap-2.5">
            <span class="w-9 h-9 bg-[#2563EB] text-white font-black rounded-lg flex items-center justify-center text-[15px] tracking-tight border-2 border-black shadow-[2px_2px_0px_0px_#000000]">A</span>
            <span class="text-[17px] font-black tracking-tight text-black">Anti-عواطلي</span>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white border-2 border-black shadow-[4px_4px_0px_0px_#000000] overflow-hidden rounded-xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
