<header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 py-3 bg-white border-b shadow-sm">
    <div class="flex-shrink-0 inline-flex gap-2 items-center">
        <h1 class="font-extrabold text-xl">
          <a href="/" class="text-gray-950 cursor-pointer block">
              <span class="text-gray-950 transition-colors duration-200 hover:text-emerald-300">Out</span>Rent
          </a>
        </h1>
    </div>

    <div class="flex items-center flex-grow mx-8 gap-4">
        <button class="font-bold text-emerald-400 hover:text-emerald-600">Kategori</button>
        <div class="relative flex-grow">
            <x-text-input type="text" placeholder="Cari di OutRent" />
        </div>
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('Keranjang') }}" class="flex items-center">
        <button class="border border-transparent hover:border-emerald-200 hover:bg-emerald-50 rounded-md p-1 transition-colors">
          <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
          </svg>
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
                                <span class="block text-heading font-medium">{{ Auth::user()->name }}</span>
                                <span class="block text-body truncate">{{ Auth::user()->email }}</span>
                            </div>
                            <ul class="p-2 text-sm text-body font-medium" aria-labelledby="user-menu-button">
                            <li>
                                <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Profil</a>
                            </li>
                            <li>
                                <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Sign out</a>
                            </li>
                            </ul>
                        </div>
                    @else
                            <x-primary-button class="px-5 py-2.5 rounded-lg ">Daftar</x-primary-button>
                            <x-secondary-button class="px-5 py-2.5 rounded-lg text-green-500">Masuk</x-secondary-button>

                    @endauth
                </nav>
            @endif
    </div>
</header>