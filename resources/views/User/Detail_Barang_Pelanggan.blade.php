<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap data barang</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-6 pt-24 space-y-4">

        {{-- Card Info Utama --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <div class="flex gap-5">

                {{-- Foto dengan Thumbnail --}}
                <div class="flex-shrink-0 flex flex-col gap-2">

                    {{-- Foto Utama --}}
                    <div class="w-44 h-36 rounded-xl bg-white border border-gray-200 overflow-hidden flex items-center justify-center">
                        <div class="flex flex-col items-center gap-2 text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <p class="text-xs">Foto Barang</p>
                        </div>
                    </div>

                    {{-- 4 Thumbnail --}}
                    <div class="grid grid-cols-4 gap-1.5">
                        @foreach([0,1,2,3] as $i)
                        <div class="aspect-square bg-white border border-gray-200 rounded-lg flex items-center justify-center cursor-pointer hover:border-emerald-400 transition">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        @endforeach
                    </div>

                </div>

                {{-- Info + Kuantitas + Tombol --}}
                <div class="flex flex-col justify-between flex-1 gap-3">

                    {{-- Info Barang --}}
                    <div class="flex flex-col gap-2">
                        <span class="inline-block px-2 py-0.5 text-xs font-medium bg-white border border-gray-200 rounded text-gray-500 w-fit">
                            Kamera
                        </span>
                        <p class="text-xl font-semibold text-gray-800">Canon EOS R50</p>
                        <p class="text-xl font-semibold text-emerald-700">
                            Rp 25.000
                            <span class="text-base font-normal text-gray-400">/ Hari</span>
                        </p>
                    </div>

                    {{-- Kuantitas & Tombol --}}
                    <div class="flex flex-col gap-3">

                        {{-- Kuantitas --}}
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-gray-600">Kuantitas:</span>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white">
                                <button onclick="ubahQty(-1)"
                                    class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition text-base font-semibold">
                                    -
                                </button>
                                <span id="qty" class="w-8 text-center text-sm font-medium text-gray-800">1</span>
                                <button onclick="ubahQty(1)"
                                    class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition text-base font-semibold">
                                    +
                                </button>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-2">
                            <x-primary-button class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 0 1-8 0"/>
                                </svg>
                                Tambah Keranjang
                            </x-primary-button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Total Sedang Dipinjam</p>
                <div class="flex items-baseline gap-1">
                    <p class="text-base font-semibold text-gray-800">20</p>
                    <p class="text-sm text-gray-500">Unit</p>
                </div>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Stok Tersedia</p>
                <p class="text-base font-semibold text-gray-800">5 Unit</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Status Barang</p>
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                    Tersedia
                </span>
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

        {{-- Tombol Kembali --}}
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('Penjualan') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>

    </div>

    {{-- Script Kuantitas --}}
    <script>
        function ubahQty(n) {
            const el  = document.getElementById('qty');
            const val = parseInt(el.textContent) + n;
            if (val >= 1 && val <= 5) el.textContent = val;
        }
    </script>

</x-app3-layout>