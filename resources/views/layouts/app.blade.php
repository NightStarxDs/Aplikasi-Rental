<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-emerald-50/40 text-gray-800">
        <div class="min-h-screen flex">
            <aside class="w-72 shrink-0 border-r border-emerald-100 bg-white">
                @include('layouts.navigation')
            </aside>

            <div class="flex-1 min-w-0 flex flex-col">

                @isset($header)
                    <header class="border-b border-emerald-100 bg-white/80 backdrop-blur">
                        <div class="px-6 py-4 md:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 p-5 md:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>