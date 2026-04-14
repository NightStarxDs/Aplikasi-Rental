<nav x-data="{ open: false }" class="bg-white">
    <div class="flex flex-col p-4">
        <div class="flex items-center space-x-3">
            <div class="shrink-0">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
            <div class="font-bold text-lg text-gray-800">
                OutRent
            </div>
        </div>

        
    </div>
    <div class="flex flex-col p-4" >
        <div class="flex flex-col space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block w-full border-none px-4 py-2 hover:bg-gray-50 rounded-md">
                {{ __('Dashboard') }}
            </x-nav-link>
            
            </div>
    </div>
    
</nav>
