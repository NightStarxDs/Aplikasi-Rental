@php
    $menuItems = [
        [
            'label' => 'Dashboard',
            'url' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
        ],
        [
            'label' => 'Inventaris',
            'url' => route('Inventaris'),
            'active' => request()->routeIs('Inventaris'),
            'icon' => '<path d="M4 6h16M4 12h16M4 18h16"/><rect x="4" y="4" width="16" height="16" rx="2"/>',
        ],
        [
            'label' => 'Transaksi',
            'url' => route('Transaksi'),
            'active' => request()->routeIs('Transaksi'),
            'icon' => '<path d="M3 10h18M7 15h1m4 0h5"/><rect x="3" y="5" width="18" height="14" rx="2"/>',
        ],
        [
            'label' => 'Kelola User',
            'url' => route('Kelola_User'),
            'active' => request()->routeIs('Kelola_User'),
            'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/>',
        ],
    ];
@endphp

<div class="h-screen flex flex-col bg-white">
    <div class="px-4 py-5 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center font-semibold text-sm shadow-sm">
                AR
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate">Aplikasi Rental</p>
                <p class="text-xs text-gray-400 truncate">Admin Panel</p>
            </div>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto px-3 py-5">
        <p class="px-2 mb-3 text-[11px] font-semibold text-gray-400 uppercase tracking-[0.12em]">Navigasi</p>

        <ul class="space-y-1">
            @foreach ($menuItems as $item)
                <li>
                    <a href="{{ $item['url'] }}"
                        class="{{ $item['active'] ? 'bg-primary/10 text-primary font-semibold shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                        <span class="text-sm">{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="px-3 py-4 border-t border-gray-100 bg-gray-50/60">
        <div class="flex items-center gap-3 px-2 py-2 mb-3 rounded-xl bg-white border border-gray-100">
            <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('profile.edit') }}"
                class="inline-flex justify-center items-center px-3 py-2 text-xs font-medium text-gray-700 rounded-lg border border-gray-200 bg-white hover:bg-gray-100 transition-colors">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full inline-flex justify-center items-center px-3 py-2 text-xs font-medium text-white rounded-lg bg-primary hover:opacity-90 transition-opacity">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>