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

        <div id="sidebar-overlay"
            class="fixed inset-0 z-20 bg-black/40 backdrop-blur-sm hidden lg:hidden"
            onclick="toggleSidebar()">
        </div>

        <div class="min-h-screen flex">

            <aside id="sidebar"
                class="fixed top-0 left-0 h-screen w-72 z-30 border-r border-emerald-100 bg-white
                        -translate-x-full transition-transform duration-300 ease-in-out
                        lg:translate-x-0 lg:static lg:z-auto lg:shrink-0">
                @include('layouts.navigation')
            </aside>

            <div class="flex-1 flex flex-col min-w-0 lg:ml-0 h-screen overflow-hidden">

                <header class="shrink-0 border-b border-emerald-100 bg-white/80 backdrop-blur">
                    <div class="flex items-center gap-3 px-4 py-4 md:px-8">

                        <button onclick="toggleSidebar()"
                                class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg
                                    text-gray-500 hover:bg-gray-100 transition-colors"
                                aria-label="Toggle sidebar">
                            <svg id="icon-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        @isset($header)
                            <div class="w-full">{{ $header }}</div>
                        @endisset
                    </div>
                </header>

                {{-- PAGE CONTENT --}}
                <main class="flex-1 overflow-y-auto p-5 md:p-8">
                    {{ $slot }}
                </main>

            </div>
        </div>

        <script>
            const sidebar   = document.getElementById('sidebar');
            const overlay   = document.getElementById('sidebar-overlay');
            const iconOpen  = document.getElementById('icon-open');
            const iconClose = document.getElementById('icon-close');
            let open = false;

            function toggleSidebar() {
                open = !open;
                sidebar.classList.toggle('-translate-x-full', !open);
                overlay.classList.toggle('hidden', !open);
                iconOpen.classList.toggle('hidden', open);
                iconClose.classList.toggle('hidden', !open);
            }
        </script>

    </body>
</html>