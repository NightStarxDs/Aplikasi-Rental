<header class="fixed top-0 left-0 right-0 z-50 flex flex-wrap items-center justify-between px-4 md:px-6 py-3 bg-white border-b shadow-sm relative">
    <style>
        /* Fallback Tailwind classes for md: prefix */
        @media (min-width: 768px) {
            .md\:order-none { order: 0 !important; }
            .md\:w-auto { width: auto !important; } 
            .md\:mt-0 { margin-top: 0 !important; }
            .md\:mx-8 { margin-left: 2rem !important; margin-right: 2rem !important; }
            .md\:me-0 { margin-inline-end: 0 !important; }
            .md\:gap-4 { gap: 1rem !important; }
            .md\:px-6 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
        }
        
        /* Global fallbacks */
        .flex-grow { flex-grow: 1 !important; }
        .justify-between { justify-content: space-between !important; }
        
        /* Mobile fallbacks */
        @media (max-width: 767px) {
            .order-2 { order: 2 !important; }
            .order-3 { order: 3 !important; }
            .flex-wrap { flex-wrap: wrap !important; }
            .w-full { width: 100% !important; }
            .flex-grow { flex-grow: 1 !important; }
        }

        /* Dropdown positioning fallback */
        #user-dropdown {
            position: absolute;
            top: 100%;
            right: 1rem;
            margin-top: 0.5rem;
        }
        .user-dropdown-active { display: block !important; }
    </style>
    
    <div class="flex-shrink-0 inline-flex gap-2 items-center" style="flex: 0 0 auto;">
        <h1 class="font-extrabold text-xl">
            <a href="/" class="text-gray-950 cursor-pointer inline-flex items-center">
                <img src="{{ asset('images/OutRent-Logo.png') }}" alt="Logo" class="h-[1.8em] w-auto mr-2"><span class="text-gray-950 transition-colors duration-200 hover:text-emerald-300">Out</span>Rent
            </a>
        </h1>
    </div>

    <!-- Search Bar -->
    <div class="order-3 mt-3 md:order-none md:mt-0 flex items-center gap-4" style="flex: 1 1 auto; margin-left: 2rem; margin-right: 2rem; min-width: 250px;">
        <form action="{{ route('penjualan.index') }}" method="GET" class="relative" style="width: 100%;">
            <x-text-input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tenda, kamera, aksesoris..." class="w-full pr-10" style="width: 100%;" />
            <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-emerald-600 hover:text-emerald-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>
    </div>

    <!-- Right Actions -->
    <div class="order-2 md:order-none flex items-center gap-2 md:gap-4" style="flex: 0 0 auto;">
        <a href="{{ route('Keranjang') }}" class="flex items-center">
        <button class="relative border border-transparent hover:border-emerald-200 hover:bg-emerald-50 rounded-md p-1 transition-colors">
            <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
            </svg>
            @php
                $cartCount = count(session('cart', []));
            @endphp
            @if($cartCount > 0)
                <div class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full">
                    {{ $cartCount }}
                </div>
            @endif
        </button>
    </a>

        <div class="h-6 w-px bg-gray-300"></div>
        @if (Route::has('login'))
                <nav class="items-center justify-end">
                    @auth
                        <div class=" bg-gray-50/60"> 
                            <button type="button" class="flex text-sm bg-neutral-primary rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <div class="flex items-center gap-3 rounded-xl bg-white border border-gray-100">
                                <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            </button>
                        </div>

                        <div class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44" id="user-dropdown">
                            <div class="px-4 py-3 text-sm border-b border-default">
                                <span class="block text-heading font-bold">{{ Auth::user()->name }}</span>
                                <span class="block text-body truncate">{{ Auth::user()->email }}</span>
                            </div>
                            <ul class="p-2 text-sm text-body font-medium" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('user.profile') }}" class="inline-flex items-center w-full p-2 rounded text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    Profil
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('users.history') }}" class="inline-flex items-center w-full p-2 rounded text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    History
                                </a>
                            </li>

                            @if(Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center w-full p-2 rounded text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150 font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="9"/>
                                        <rect x="14" y="3" width="7" height="5"/>
                                        <rect x="14" y="12" width="7" height="9"/>
                                        <rect x="3" y="16" width="7" height="5"/>
                                    </svg>
                                    Dashboard Admin
                                </a>
                            </li>
                            @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center w-full p-2 rounded text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                            <polyline points="16 17 21 12 16 7"/>
                                            <line x1="21" y1="12" x2="9" y2="12"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                            </ul>
                        </div>
                    @else
                            <a href="{{ route('login') }}" class="bg-emerald-800 font-semibold text-white transition-all hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95 px-5 py-2.5 rounded-lg ">Daftar</a>
                            <a href="{{ route('login') }}" class="border border-emerald-400 font-medium text-green bg-transparent transition-all hover:bg-emerald/10 hover:border-emerald-200 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95 px-5 py-2.5 rounded-lg text-green-500">Masuk</a>

                    @endauth
                </nav>
            @endif
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuBtn = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                    userDropdown.classList.toggle('user-dropdown-active');
                });
                
                // Close when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                        userDropdown.classList.remove('user-dropdown-active');
                    }
                });
            }
        });
    </script>
</header>