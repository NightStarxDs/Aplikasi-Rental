<nav x-data="{ open: false }" class="fixed top-0 z-50 bg-[#014737] border-b border-gray-100 h-screen w-64">
    <div class="flex flex-col p-4">
        <div class="flex items-center space-x-3">
            <div class="shrink-0">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
            <div class="font-bold text-lg text-white">
                <h2 class="font-black text-xl text-white-800 leading-tight">
            {{ __('OutRent') }}
        </h2>
            </div>
        </div> <br><hr><hr><hr><hr>

        
    </div>
<div class="flex flex-col p-4">
    <div class="flex flex-col space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
            class="flex items-center gap-3 w-full border-none px-4 py-2 rounded-md text-white text-[17px] hover:bg-green-950 hover:text-white">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
            </svg> 
            <span> {{ __('Beranda') }} </span>
        </x-nav-link> <hr>

        <x-nav-link :href="route('Inventaris')" :active="request()->routeIs('Inventaris')" 
        class="flex items-center gap-3 w-full border-none px-4 py-2 rounded-md text-white text-[17px] hover:bg-green-950 hover:text-white">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
</svg>

            {{ __('Manajemen Inventaris') }}
        </x-nav-link> <hr>

        <x-nav-link :href="route('Transaksi')" :active="request()->routeIs('Transaksi')" 
        class="flex items-center gap-3 w-full border-none px-4 py-2 rounded-md text-white text-[17px] hover:bg-green-950 hover:text-white">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M16.5 15v1.5m0 0V18m0-1.5H15m1.5 0H18M3 9V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3M3 9v6a1 1 0 0 0 1 1h5M3 9h16m0 0v1M6 12h3m12 4.5a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/>
</svg>

            {{ __('Transaksi Penyewaan') }}
        </x-nav-link>   <hr>

        <x-nav-link :href="route('Kelola_User')" :active="request()->routeIs('Kelola_User')" class="flex items-center gap-3 w-full border-none px-4 py-2 rounded-md text-white text-[17px] hover:bg-green-950 hover:text-white">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM12 14a7 7 0 0 0-7 7h14a7 7 0 0 0-7-7Z"/>
</svg>
            {{ __('Kelola Pengguna') }}
        </x-nav-link>
    </div>
</div>
    
</nav>
