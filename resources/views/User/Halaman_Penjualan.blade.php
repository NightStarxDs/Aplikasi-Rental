<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Halaman Penjualan</h1>
                <p class="text-sm text-gray-500 mt-1">Temukan dan sewa peralatan yang kamu butuhkan</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-[35px] px-6 pb-6 space-y-5">

        {{-- Hero Banner --}}
        <div class="grid grid-cols-3 gap-3 h-48">
            <div class="col-span-2 rounded-2xl overflow-hidden relative">
                <img src="{{ asset('images/banner-utama.jpg') }}" alt="Banner Utama"
                     class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/banner-foto-1.jpg') }}" alt="Foto 1"
                         class="w-full h-full object-cover">
                </div>
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/banner-foto-2.jpg') }}" alt="Foto 2"
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4">
            <div class="flex items-start gap-6">
                <div class="flex flex-col gap-2">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Alat Camping</p>
                    <div class="flex items-center gap-2">
                        @foreach (['Tenda', 'Sleeping Bag', 'Matras', 'Kompor'] as $item)
                        <button class="flex flex-col items-center gap-1.5 w-16 h-16 bg-white border border-gray-200 rounded-xl justify-center hover:border-emerald-500 hover:bg-emerald-50 transition group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span class="text-xs text-gray-400 group-hover:text-emerald-600 transition leading-none">{{ $item }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                <div class="h-20 w-px bg-gray-200 self-center"></div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kamera</p>
                    <div class="flex items-center gap-2">
                        @foreach (['Canon', 'Sony', 'Nikon', 'GoPro'] as $item)
                        <button class="flex flex-col items-center gap-1.5 w-16 h-16 bg-white border border-gray-200 rounded-xl justify-center hover:border-emerald-500 hover:bg-emerald-50 transition group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span class="text-xs text-gray-400 group-hover:text-emerald-600 transition leading-none">{{ $item }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Kami --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-700">Produk Kami</h2>
                <a href="#" class="text-xs text-emerald-700 hover:underline font-medium">Lihat semua →</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach ([
                    ['id' => 1, 'nama' => 'Canon EOS R50',   'harga' => 'Rp 25.000', 'kat' => 'Kamera',  'foto' => 'canon-eos-r50.jpg'],
                    ['id' => 2, 'nama' => 'Tenda Dome 4P',   'harga' => 'Rp 50.000', 'kat' => 'Camping', 'foto' => 'tenda-dome.jpg'],
                    ['id' => 3, 'nama' => 'Sony A7 III',     'harga' => 'Rp 40.000', 'kat' => 'Kamera',  'foto' => 'sony-a7iii.jpg'],
                    ['id' => 4, 'nama' => 'Sleeping Bag',    'harga' => 'Rp 15.000', 'kat' => 'Camping', 'foto' => 'sleeping-bag.jpg'],
                    ['id' => 5, 'nama' => 'DJI Osmo Pocket', 'harga' => 'Rp 20.000', 'kat' => 'Kamera',  'foto' => 'dji-osmo.jpg'],
                    ['id' => 6, 'nama' => 'Matras Gunung',   'harga' => 'Rp 8.000',  'kat' => 'Camping', 'foto' => 'matras.jpg'],
                    ['id' => 7, 'nama' => 'GoPro Hero 12',   'harga' => 'Rp 18.000', 'kat' => 'Kamera',  'foto' => 'gopro-hero12.jpg'],
                    ['id' => 8, 'nama' => 'Carrier 60L',     'harga' => 'Rp 35.000', 'kat' => 'Camping', 'foto' => 'carrier-60l.jpg'],
                ] as $produk)

                <a href="{{ route('Detail_Barang_Pelanggan', $produk['id']) }}"
                   class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-emerald-400 hover:shadow-sm transition group">
                    {{-- Foto Produk --}}
                    <div 
                        class="w-full h-[210px] overflow-hidden bg-cover bg-center group-hover:scale-105 transition duration-300"
                        style="background-image: url('{{ asset('images/sonyA7.png') }}');">
                    </div>
                    {{-- Info --}}
                    <div class="p-3 space-y-1.5">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $produk['nama'] }}</p>
                        <p class="text-xs font-semibold text-emerald-700">
                            {{ $produk['harga'] }}<span class="text-gray-400 font-normal">/Hari</span>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 text-gray-500 rounded-md">
                                {{ $produk['kat'] }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs text-emerald-600 font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                Tersedia
                            </span>
                        </div>
                    </div>
                </a>

                @endforeach

            </div>
        </div>

    </div>
</x-app3-layout>