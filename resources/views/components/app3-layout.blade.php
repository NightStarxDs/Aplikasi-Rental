<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OutRent') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-gray-200 font-sans antialiased">
    @include('layouts.navigation3')

    <main class="pt-[70px]">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

<div id="small-footer" class="fixed bottom-0 left-0 w-full bg-white border-t border-emerald-100 py-3 text-sm z-40 transition-transform duration-500 translate-y-0 shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-between items-center px-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <span class="font-bold text-gray-900"><span class="text-emerald-600">Out</span>Rent</span>
                <span class="hidden sm:inline text-gray-400">|</span>
                <span class="hidden sm:inline text-gray-600">Sewa Alat Camping & Kamera</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-500 hidden md:inline">Copyright &copy; 2025</span>
            </div>
        </div>
    </div>
</html>