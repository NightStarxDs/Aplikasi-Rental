<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Halaman Penjualan</h1>
                <p class="text-sm text-gray-500 mt-1">Temukan dan sewa peralatan yang kamu butuhkan</p>
            </div>
        </div>
    </x-slot>

    <div class="pt-[30px] px-6 pb-6 space-y-10">

        {{-- Hero Banner --}}
        <div class="grid grid-cols-3 gap-3 h-48">
            <div class="col-span-2 rounded-2xl overflow-hidden relative">
                <img src="{{ asset('images/Test.jpg') }}" alt="Banner Utama"
                     class="w-full h-full object-cover bg-no-repeat bg-center">
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/Test.jpg') }}" alt="Foto 1"
                         class="w-full h-full object-cover bg-no-repeat bg-center">
                </div>
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/Test.jpg') }}" alt="Foto 2"
                         class="w-full h-full object-cover bg-no-repeat bg-center">
                </div>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-4 sm:p-5 lg:p-6">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 lg:gap-6">
                <div class="flex h-full flex-col gap-3 rounded-xl bg-white/70 p-3 sm:p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Alat Camping</p>
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                        @foreach (['Tenda', 'Sleeping Bag', 'Matras', 'Kompor'] as $item)
                        <button class="group relative h-20 w-full overflow-hidden rounded-xl border border-gray-200 transition hover:border-emerald-500">
                            <img
                                src="{{ asset(match($item) {
                                    'Tenda' => 'images/Tent.jpg',
                                    'Sleeping Bag' => 'images/sleapingbag.jpg',
                                    'Matras' => 'images/Matras.png',
                                    'Kompor' => 'images/Kompor-Portable.jpg',
                                    default => 'images/tendadome.jpg',
                                }) }}"
                                alt="{{ $item }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/35 transition group-hover:bg-black/45"></div>
                            <span class="absolute inset-x-1 bottom-1 text-center text-[11px] font-medium text-white leading-none">{{ $item }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                <div class="flex h-full flex-col gap-3 rounded-xl bg-white/70 p-3 sm:p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Kamera</p>
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                        @foreach (['Canon', 'Sony', 'Nikon', 'GoPro'] as $item)
                        <button class="group relative h-20 w-full overflow-hidden rounded-xl border border-gray-200 transition hover:border-emerald-500">
                            <img
                                src="{{ asset(match($item) {
                                    'Canon' => 'images/canon.png',
                                    'Sony' => 'images/sonyA7.png',
                                    'Nikon' => 'images/Nikon-D500.jpg',
                                    'GoPro' => 'images/Go-Pro.jpg',
                                    default => 'images/dji-osmo.jpg',
                                }) }}"
                                alt="{{ $item }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/35 transition group-hover:bg-black/45"></div>
                            <span class="absolute inset-x-1 bottom-1 text-center text-[11px] font-medium text-white leading-none">{{ $item }}</span>
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