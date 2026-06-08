<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Halaman Penjualan</h1>
                <p class="text-sm text-gray-500 mt-1">Temukan dan sewa peralatan yang kamu butuhkan</p>
            </div>
        </div>
    </x-slot>

    <div class="px-6 space-y-5">

        <!-- Hero Banner -->
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

        <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-4 sm:p-5 lg:p-6">
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 lg:gap-6">
        
        {{-- Alat Camping --}}
        <div class="flex h-full flex-col gap-3 rounded-xl bg-white/70 p-3 sm:p-4">
            <a href="{{ route('penjualan.index', ['kategori' => 'Alat Camping']) }}" 
            class="text-xs font-semibold text-gray-500 uppercase tracking-wider hover:text-emerald-600 transition">
                Alat Camping →
            </a>
            
            <div class="grid grid-cols-8 gap-2">
                @foreach ([
                    'Tenda'        => ['db' => 'Tenda',             'icon' => 'fa-house'],
                    'Sleeping Bag' => ['db' => 'Peralatan Tidur',   'icon' => 'fa-bed'],
                    'Cooking Set'  => ['db' => 'Peralatan Memasak', 'icon' => 'fa-fire-burner'],
                    'Penerangan'   => ['db' => 'Penerangan',        'icon' => 'fa-lightbulb'],
                    'Power & Gas'  => ['db' => 'Power',             'icon' => 'fa-gas-pump'],
                ] as $label => $data)
                <a href="{{ route('penjualan.index', ['kategori' => 'Alat Camping', 'subkategori' => $data['db']]) }}" 
                class="group h-20 w-20 rounded-xl border flex flex-col items-center justify-center gap-2
                    {{ request('subkategori') == $data['db'] 
                        ? 'border-emerald-500 ring-2 ring-emerald-500/20 bg-emerald-50 text-emerald-600' 
                        : 'border-gray-200 bg-white text-gray-400' }} 
                    transition hover:border-emerald-500 hover:text-emerald-600 hover:bg-emerald-50">
                    <i class="fa-solid {{ $data['icon'] }} text-xl"></i>
                    <span class="text-[10px] font-medium leading-tight text-center px-1">{{ $label }}</span>
                </a>
                @endforeach
                @for ($i = 0; $i < (8 - count([
                    'Tenda', 'Sleeping Bag', 'Cooking Set', 'Penerangan', 'Power & Gas'
                ])); $i++)
                    <div class="h-20 w-20"></div>
                @endfor
            </div>
        </div>

        {{-- Kamera --}}
        <div class="flex h-full flex-col gap-3 rounded-xl bg-white/70 p-3 sm:p-4">
            <a href="{{ route('penjualan.index', ['kategori' => 'Kamera']) }}" 
            class="text-xs font-semibold text-gray-500 uppercase tracking-wider hover:text-emerald-600 transition">
                Kamera →
            </a>
            
            <div class="grid grid-cols-8 gap-2">
                @foreach ([
                    'DSLR'       => ['db' => 'DSLR Cam',         'icon' => 'fa-camera'],
                    'Mirrorless' => ['db' => 'Mirrorless Cam',   'icon' => 'fa-camera-retro'],
                    'Video'      => ['db' => 'Video Cam',        'icon' => 'fa-video'],
                    'Action'     => ['db' => 'Action Cam',       'icon' => 'fa-person-running'],
                    'Lensa'      => ['db' => 'Lensa',            'icon' => 'fa-circle-dot'],
                    'Aksesoris'  => ['db' => 'Aksesoris Kamera', 'icon' => 'fa-toolbox'],
                ] as $label => $data)
                <a href="{{ route('penjualan.index', ['kategori' => 'Kamera', 'subkategori' => $data['db']]) }}" 
                class="group h-20 w-20 rounded-xl border flex flex-col items-center justify-center gap-2
                    {{ request('subkategori') == $data['db'] 
                        ? 'border-emerald-500 ring-2 ring-emerald-500/20 bg-emerald-50 text-emerald-600' 
                        : 'border-gray-200 bg-white text-gray-400' }} 
                    transition hover:border-emerald-500 hover:text-emerald-600 hover:bg-emerald-50">
                    <i class="fa-solid {{ $data['icon'] }} text-xl"></i>
                    <span class="text-[10px] font-medium leading-tight text-center px-1">{{ $label }}</span>
                </a>
                @endforeach
                @for ($i = 0; $i < (8 - count([
                    'DSLR', 'Mirrorless', 'Video', 'Action', 'Lensa', 'Aksesoris'
                ])); $i++)
                    <div class="h-20 w-20"></div>
                @endfor
            </div>
        </div>
    </div>
</div>

        <!-- Produk Kami -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-700">Produk Kami</h2>
                <a href="{{ route('penjualan.index') }}" class="text-xs text-emerald-700 hover:underline font-medium">Lihat semua →</a>
            </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @forelse($barang as $item)
                <form action="{{ route('Detail_Barang_Pelanggan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->kode_barang }}">
                <button type="submit" class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:border-emerald-400 transition flex flex-col">

                    {{-- Gambar Square --}}
                    <div class="aspect-square w-full overflow-hidden bg-gray-100">
                        <img src="{{ $item->fotoUtamaUrl() ?? asset('images/default-placeholder.jpg') }}"
                            alt="{{ $item->nama_barang }}"
                            class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    </div>

                    {{-- Info --}}
                    <div class="p-2 flex flex-col gap-0.5 text-left">
                        <span class="text-[9px] font-semibold text-emerald-600 uppercase tracking-wider truncate">
                            {{ $item->labelKategori() }} · {{ $item->subkategori_barang }}
                        </span>
                        <h5 class="text-xs font-bold text-gray-800 line-clamp-1 group-hover:text-emerald-700 transition">
                            {{ $item->nama_barang }}
                        </h5>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-xm font-bold text-orange-400">
                                Rp {{ number_format($item->harga_perhari, 0, ',', '.') }}
                            </span>
                            <span class="text-[15px] text-gray-400">/ hari</span>
                        </div>
                    </div>
                </button>
                </form>
            @empty
                <div class="col-span-2 md:col-span-4 lg:col-span-6 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Tidak ada produk yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/f19fb034db.js" crossorigin="anonymous"></script>
</x-app3-layout>