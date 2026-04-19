<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap data barang</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                Inventaris Aktif
            </span>
        </div>
    </x-slot>

    <div class="py-6 px-6 space-y-4">

        {{-- Card Info Utama --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 flex gap-5">

            {{-- Foto --}}
            <div class="flex-shrink-0 w-44 h-36 rounded-xl bg-white border border-gray-200 overflow-hidden flex items-center justify-center">
                <div class="flex flex-col items-center gap-2 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <p class="text-xs">Foto Barang</p>
                </div>
            </div>

            {{-- Info --}}
            <div class="flex flex-col justify-center gap-3">
                <span class="inline-block px-2 py-0.5 text-xs font-medium bg-white border border-gray-200 rounded text-gray-500 w-fit">
                    Kamera
                </span>
                <p class="text-lg font-semibold text-gray-800">Canon EOS R50</p>
                <p class="text-base font-semibold text-emerald-700">
                    Rp 25.000
                    <span class="text-xs font-normal text-gray-400">/ Jam</span>
                </p>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Stok tersedia:</span>
                    <span class="text-sm font-medium text-gray-800">5 unit</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                        Tersedia
                    </span>
                </div>
            </div>

        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Total Dipinjam</p>
                <p class="text-base font-semibold text-gray-800">128 kali</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Ditambahkan</p>
                <p class="text-base font-semibold text-gray-800">01 Jan 2025</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Terakhir Diupdate</p>
                <p class="text-base font-semibold text-gray-800">10 Apr 2026</p>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Barang</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Kamera mirrorless Canon EOS R50 dengan sensor APS-C 24.2 MP, cocok untuk pemula
                maupun vlogger. Dilengkapi dengan fitur autofocus cepat, stabilisasi video, dan
                layar putar. Ringan dan mudah dibawa ke mana saja. Tersedia dengan lensa kit 18-45mm.
            </p>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('Inventaris') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>

            <div class="flex items-center gap-2">

                {{-- Hapus --}}
                <button onclick="return confirm('Yakin ingin menghapus barang ini?')"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-red-50 text-red-700 border border-red-100 rounded-lg hover:bg-red-100 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                    </svg>
                    Hapus
                </button>

                {{-- Edit --}}
                <a href="{{ route('Edit_Barang') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100 rounded-lg hover:bg-blue-100 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Edit
                </a>

            </div>
        </div>

    </div>
</x-app-layout>