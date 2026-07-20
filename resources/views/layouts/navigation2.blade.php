<nav class="fixed start-0 top-0 z-20 w-full border-b border-gray-200 bg-white text-gray-800">
    <div class="flex h-[60px] w-full max-w-[1440px] mx-auto px-4 md:px-6 items-center justify-between">
        <h1 class="font-extrabold text-xl flex items-center">
            <a href="/" class="text-gray-950 cursor-pointer inline-flex items-center">
                <img src="{{ asset('images/OutRent-Logo.png') }}" alt="Logo" class="h-[1.8em] w-auto mr-2">
                <span class="text-gray-950 transition-colors duration-200 hover:text-emerald-300">Out</span>Rent
            </a>
        </h1>

        <button data-collapse-toggle="mega-menu-full" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden
                hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="mega-menu-full" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
            </svg>
        </button>

        <div id="mega-menu-full" class="hidden w-full md:flex md:w-auto md:order-1  absolute top-[60px] left-0 right-0 bg-white border-b border-gray-200 shadow-md px-6 py-4 md:static md:bg-transparent md:border-0 md:shadow-none md:p-0">
            <ul class="flex flex-col font-medium md:flex-row md:items-center md:space-x-8 rtl:space-x-reverse">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 text-primary font-semibold border-b-2 border-primary
                            md:border-b-2 md:border-primary md:p-0 md:pb-1"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <button id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown"
                        class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-600
                            border-b border-gray-100 md:w-auto md:border-0
                            hover:text-primary md:p-0 transition-colors duration-150">
                        Katalog
                        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>
                    </button>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-gray-600 border-b border-gray-100
                            hover:text-primary md:border-0 md:p-0 transition-colors duration-150">Marketplace</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-gray-600 border-b border-gray-100
                            hover:text-primary md:border-0 md:p-0 transition-colors duration-150">Resources</a>
                </li>
                <li class="py-2 px-3 md:p-0">
                    <a href="{{ route('login') }}">
                        <x-secondary-button class="px-5 py-2.5 rounded-lg text-green-500">Masuk</x-secondary-button>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Mobile dropdown renders outside the fixed-height bar --}}
    <div id="mega-menu-full-dropdown" class="bg-white border-gray-100 shadow-sm border-y hidden">
        <div class="max-w-[1440px] mx-auto px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <div class="flex flex-col space-y-2">
                    <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-xs mb-1">Kamera & Fotografi</h3>
                    <hr class="border-gray-100 mb-4">
                    <details class="group outline-none">
                        <summary class="flex items-center justify-between cursor-pointer list-none p-2 text-gray-700 font-medium hover:text-primary transition-colors">
                            <span>Kamera</span>
                            <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="flex flex-col ml-4 space-y-2 mt-1 mb-4 text-sm text-gray-500">
                            <a href="{{ route('penjualan.index', ['subkategori' => 'DSLR Cam']) }}" class="hover:text-primary transition-colors duration-150">DSLR</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Mirrorless Cam']) }}" class="hover:text-primary transition-colors duration-150">Mirrorless</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Action Cam']) }}" class="hover:text-primary transition-colors duration-150">Action Cam</a>
                        </div>
                    </details>
                    <details class="group outline-none">
                        <summary class="flex items-center justify-between cursor-pointer list-none p-2 text-gray-700 font-medium hover:text-primary transition-colors">
                            <span>Lensa</span>
                            <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="flex flex-col ml-4 space-y-2 mt-1 mb-4 text-sm text-gray-500">
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Lensa']) }}" class="hover:text-primary transition-colors duration-150">Lensa Prime</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Lensa']) }}" class="hover:text-primary transition-colors duration-150">Lensa Tele</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Lensa']) }}" class="hover:text-primary transition-colors duration-150">Lensa Wide</a>
                        </div>
                    </details>
                </div>

                <div class="flex flex-col space-y-2">
                    <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-xs mb-1">Peralatan Camping</h3>
                    <hr class="border-gray-100 mb-4">
                    <details class="group outline-none">
                        <summary class="flex items-center justify-between cursor-pointer list-none p-2 text-gray-700 font-medium hover:text-primary transition-colors">
                            <span>Tenda</span>
                            <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="flex flex-col ml-4 space-y-2 mt-1 mb-4 text-sm text-gray-500">
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Tenda']) }}" class="hover:text-primary transition-colors duration-150">Tenda Dome (2-4 org)</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Tenda']) }}" class="hover:text-primary transition-colors duration-150">Tenda Keluarga (6+ org)</a>
                        </div>
                    </details>
                    <details class="group outline-none">
                        <summary class="flex items-center justify-between cursor-pointer list-none p-2 text-gray-700 font-medium hover:text-primary transition-colors">
                            <span>Alat Masak</span>
                            <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="flex flex-col ml-4 space-y-2 mt-1 mb-4 text-sm text-gray-500">
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Peralatan Memasak']) }}" class="hover:text-primary transition-colors duration-150">Kompor Portable</a>
                            <a href="{{ route('penjualan.index', ['subkategori' => 'Peralatan Memasak']) }}" class="hover:text-primary transition-colors duration-150">Nesting / Cookware</a>
                        </div>
                    </details>
                </div>

            </div>
        </div>
    </div>
</nav>