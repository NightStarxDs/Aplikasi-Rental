<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Detail Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap data barang</p>
            </div>
        </div>
    </x-slot>

    @php
        $fotos = collect($barang->gambar_barang ?? [])->map(fn ($f) => asset('storage/' . $f))->values();
        $fotoUtama = $fotos->first();
        $thumbnailFotos = $fotos->slice(1);
        $statusClass = match ($barang->status_barang) {
            'Tersedia' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-800', 'dot' => 'bg-emerald-500'],
            'Sedikit' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-800', 'dot' => 'bg-amber-500'],
            default => ['bg' => 'bg-red-50', 'text' => 'text-red-800', 'dot' => 'bg-red-400'],
        };
    @endphp
    
    <div class="py-6 px-6 pt-15 space-y-4"  x-data="{ activeFoto: @js($fotoUtama) }">

        {{-- Card Info Utama --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <div class="flex gap-5">

            {{-- Foto dengan Thumbnail --}}
            <div class="flex-shrink-0 flex flex-col gap-2">
                <div class="w-[295px] h-[250px] rounded-xl bg-white border border-gray-200 overflow-hidden flex items-center justify-center">
                    <template x-if="activeFoto">
                        <div class="w-full h-full bg-cover bg-center transition duration-300"
                            :style="`background-image: url('${activeFoto}')`"></div>
                    </template>
                    <template x-if="!activeFoto">
                        <span class="text-sm text-gray-400">Tidak ada foto</span>
                    </template>
                </div>

                    @if ($thumbnailFotos->count() > 0)
                    <div class="grid grid-cols-4 gap-1.5">
                        @foreach ($thumbnailFotos as $foto)
                            <button type="button"
                                @click="activeFoto = '{{ $foto }}'"
                                :class="activeFoto === '{{ $foto }}' ? 'border-emerald-500 ring-1 ring-emerald-500' : 'border-gray-200'"
                                class="aspect-square bg-white border rounded-lg cursor-pointer hover:border-emerald-400 transition bg-cover bg-center"
                                style="background-image: url('{{ $foto }}');">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

                {{-- Info + Kuantitas + Tombol --}}
                <div class="flex flex-col justify-between flex-1 gap-3">

                    {{-- Info Barang --}}
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                        <span class="inline-block px-2 py-0.5 text-xs font-medium bg-white border border-gray-200 rounded text-gray-500 w-fit">
                            {{ $barang->kategori_barang }} 
                        </span>
                        <span class="inline-block px-2 py-0.5 text-xs font-medium bg-white border border-gray-200 rounded text-gray-500 w-fit">
                            {{ $barang->subkategori_barang }} 
                        </span>
                    </div>
                        <p class="text-5xl font-bold text-gray-800">{{ $barang->nama_barang }}</p>
                        <p class="text-3xl font-semibold text-emerald-700">
                            Rp {{ number_format($barang->harga_perhari, 0, ',', '.') }}
                            <span class="text-base font-normal text-gray-400">/ Hari</span>
                        </p>
                        <p class="text-3xl font-semibold text-emerald-700">
                            Rp {{ number_format($barang->harga_perjam, 0, ',', '.') }}
                            <span class="text-base font-normal text-gray-400">/ Jam</span>
                        </p>
                    

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
                    </div>
                        <form action="{{ route('cart.add', $barang->kode_barang) }}" method="POST">
                        @csrf
                        <input type="hidden" name="qty" id="qty-input" value="1">
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
                        </form>
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
                <p class="text-base font-semibold text-gray-800">{{ $barang->stok }} Unit</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Status Barang</p>    
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $statusClass['bg'] }} {{ $statusClass['text'] }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $statusClass['dot'] }}"></span>
                {{ $barang->status_barang }}
</span>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Barang</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                {{ $barang->deskripsi_barang ?: 'Tidak ada deskripsi untuk barang ini.' }}
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <div class="flex items-center justify-between pt-1">
            <a href="{{ route('penjualan.index') }}"
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
            if (val >= 1 && val <= 5) {
                el.textContent = val;
                document.getElementById('qty-input').value = val;
            }
        }
    </script>

</x-app3-layout>