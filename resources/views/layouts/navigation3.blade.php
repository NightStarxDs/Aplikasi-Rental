<header class="flex items-center justify-between px-6 py-3 bg-white border-b shadow-sm">
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
        <a href="{{ route('Keranjang') }}" class="flex items> 
        <button class="border border-transparent hover:border-emerald-200 hover:bg-emerald-50 rounded-md p-1 transition-colors">
          <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
          </svg>
        </button>
    </a>
          
        <div class="h-6 w-px bg-gray-300"></div> <x-secondary-button class="px-5 py-2.5 rounded-lg">Masuk</x-secondary-button>
        <x-primary-button class="px-5 py-2.5 rounded-lg ">Daftar</x-primary-button>
    </div>
</header>