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

    {{-- ─── Floating Back Button ─── --}}
    <a href="{{ route('penjualan.index') }}"
        class="fixed top-[82px] left-4 z-30 inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl shadow-md hover:bg-gray-50 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 group">
        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali
    </a>

    <div class="py-6 px-6 pt-15 space-y-4" x-data="{
        fotos: @js($fotos),
        modalOpen: false,
        showSuccess: true,
        showError: true,
        swapFoto(index) {
            let newFotos = [...this.fotos];
            let temp = newFotos[0];
            newFotos[0] = newFotos[index];
            newFotos[index] = temp;
            this.fotos = newFotos;
        },
        nextFoto() {
            if (this.fotos.length > 1) {
                let newFotos = [...this.fotos];
                let first = newFotos.shift();
                newFotos.push(first);
                this.fotos = newFotos;
            }
        },
        prevFoto() {
            if (this.fotos.length > 1) {
                let newFotos = [...this.fotos];
                let last = newFotos.pop();
                newFotos.unshift(last);
                this.fotos = newFotos;
            }
        }
    }">
        @if (session('success'))
            <div x-show="showSuccess" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="showSuccess = false" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div x-show="showError" class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button @click="showError = false" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Card Info Utama --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <div class="flex flex-col md:flex-row gap-5">

            {{-- Foto dengan Thumbnail --}}
            <div class="w-full md:w-1/3 lg:w-96 flex-shrink-0 flex flex-col items-center md:items-start gap-2 relative">
                <div @click="if(fotos.length > 0) modalOpen = true" class="w-full aspect-square sm:aspect-[4/3] rounded-xl bg-white border border-gray-200 overflow-hidden flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-emerald-400 transition">
                    <template x-if="fotos.length > 0">
                        <div class="w-full h-full bg-cover bg-center transition duration-300"
                            :style="`background-image: url('${fotos[0]}')`"></div>
                    </template>
                    <template x-if="fotos.length === 0">
                        <span class="text-sm text-gray-400">Tidak ada foto</span>
                    </template>
                </div>

                <template x-if="fotos.length > 1">
                    <div class="flex flex-wrap justify-center gap-1.5 w-full">
                        <template x-for="(foto, index) in fotos" :key="'thumb-'+foto">
                            <template x-if="index > 0">
                                <button type="button"
                                    @click="swapFoto(index)"
                                    class="w-[54px] h-[54px] bg-white border border-gray-200 rounded-lg cursor-pointer hover:border-emerald-400 transition bg-cover bg-center"
                                    :style="`background-image: url('${foto}');`">
                                </button>
                            </template>
                        </template>
                    </div>
                </template>
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
                        <div class="flex flex-col gap-1">
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
                            @php $maxQty = min(3, $barang->stok); @endphp
                            <p class="text-xs text-gray-400">
                                Maks. <span class="font-semibold text-gray-500">{{ $maxQty }}</span> unit per pelanggan
                                @if($barang->stok < 3)
                                    <span class="text-amber-500">(stok tersisa {{ $barang->stok }})</span>
                                @endif
                            </p>
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
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Telah Disewa</p>
                <div class="flex items-baseline gap-1">
                    <p class="text-base font-semibold text-gray-800">
                        {{ $barang->total_disewa }}
                    </p>
                    <p class="text-sm text-gray-500">Kali</p>
                </div>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Stok Tersedia</p>
                <div class="flex items-baseline gap-1">
                    <p class="text-base font-semibold text-gray-800">{{ $barang->stok }}</p>
                    <p class="text-sm text-gray-500">Unit</p>
                </div>
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


        {{-- Modal Image --}}
        <div x-show="modalOpen" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white p-8" x-transition.opacity style="display: none;">
            
            {{-- Tombol Close --}}
            <button @click="modalOpen = false" class="absolute top-6 right-6 z-10 text-gray-500 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-full p-2 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="flex flex-col gap-8 w-full max-w-6xl h-full items-center justify-center" @click.away="modalOpen = false">
                
                {{-- Gambar Utama Modal --}}
                <template x-if="fotos.length > 0">
                    <div class="relative w-full flex-1 min-h-0 flex items-center justify-center group">
                        
                        {{-- Tombol Kiri --}}
                        <template x-if="fotos.length > 1">
                            <button @click.stop="prevFoto()" class="absolute left-4 md:left-8 z-20 p-3 rounded-full bg-white/80 hover:bg-white text-gray-800 shadow-md transition-all opacity-0 group-hover:opacity-100 focus:opacity-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                        </template>

                        <div class="w-full h-full bg-contain bg-center bg-no-repeat rounded-xl" :style="`background-image: url('${fotos[0]}')`"></div>
                        
                        {{-- Tombol Kanan --}}
                        <template x-if="fotos.length > 1">
                            <button @click.stop="nextFoto()" class="absolute right-4 md:right-8 z-20 p-3 rounded-full bg-white/80 hover:bg-white text-gray-800 shadow-md transition-all opacity-0 group-hover:opacity-100 focus:opacity-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </template>
                    </div>
                </template>

                {{-- Thumbnail Modal (Bawah) --}}
                <template x-if="fotos.length > 1">
                    <div class="flex flex-row gap-4 w-full justify-center overflow-x-auto pb-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                        <template x-for="(foto, index) in fotos" :key="'modal-'+foto">
                            <template x-if="index > 0">
                                <button type="button"
                                    @click="swapFoto(index)"
                                    class="w-[70px] h-[70px] flex-shrink-0 bg-white border border-gray-300 rounded-xl cursor-pointer hover:border-emerald-400 hover:ring-2 hover:ring-emerald-400 transition bg-cover bg-center"
                                    :style="`background-image: url('${foto}');`">
                                </button>
                            </template>
                        </template>
                    </div>
                </template>
            </div>
        </div>

    </div>

    {{-- Script Kuantitas --}}
    <script>
        const maxQty = {{ min(3, $barang->stok) }};

        function ubahQty(n) {
            const el  = document.getElementById('qty');
            const val = parseInt(el.textContent) + n;
            if (val >= 1 && val <= maxQty) {
                el.textContent = val;
                document.getElementById('qty-input').value = val;
            }
        }
    </script>

</x-app3-layout>