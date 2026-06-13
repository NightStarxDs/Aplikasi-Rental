<x-app-layout> 
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Manajemen Inventaris Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh data barang dan stok tersedia</p>
            </div>

            <a href="{{ route('Tambah_Barang')}}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('Inventaris') }}" class="flex flex-wrap gap-2 items-end mb-4">

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Kategori</label>
                <select name="kategori" id="filter-kategori" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none focus:ring-2 focus:ring-emerald-200" autocomplete="off">
                    <option value="">Semua Kategori</option>
                    <option value="Kamera" {{ request('kategori') === 'Kamera' ? 'selected' : '' }}>Kamera</option>
                    <option value="Alat Camping" {{ request('kategori') === 'Alat Camping' ? 'selected' : '' }}>Alat Camping</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Subkategori</label>
                <select name="subkategori" id="filter-subkategori" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none focus:ring-2 focus:ring-emerald-200" autocomplete="off" {{ request('kategori') ? '' : 'disabled' }}>
                    <option value="">Semua Subkategori</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-medium text-gray-500">Stok</label>
                <select name="status" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none focus:ring-2 focus:ring-emerald-200" autocomplete="off">
                    <option value="">Semua Stok</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="sedikit" {{ request('status') === 'sedikit' ? 'selected' : '' }}>Sedikit</option>
                </select>
            </div>

            <div class="flex flex-col gap-1 flex-1 min-w-[160px]">
                <label class="text-xs font-medium text-gray-500">Nama Barang</label>
                <input name="search" type="text" value="{{ request('search') }}" placeholder="Cari nama barang..." class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" autocomplete="off">
            </div>

            <div class="flex gap-2 items-end">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-transparent select-none">_</label>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        Filter
                    </button>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-transparent select-none">_</label>
                    <a href="{{ route('Inventaris') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        Reset
                    </a>
                </div>
            </div>

        </form>

        <script>
            const subkategoriMap = {
                'Kamera': ['DSLR Cam', 'Mirrorless Cam', 'Video Cam', 'Action Cam', 'Lensa', 'Aksesoris Kamera', 'Lighting', 'Audio'],
                'Alat Camping': ['Tenda', 'Peralatan Tidur', 'Peralatan Memasak', 'Penerangan', 'Power'],
            };

            const kategoriEl = document.getElementById('filter-kategori');
            const subkategoriEl = document.getElementById('filter-subkategori');
            const selectedSubkategori = '{{ request('subkategori') }}';

            function updateSubkategoriOptions() {
                const kategori = kategoriEl.value;
                const options = subkategoriMap[kategori] || [];
                subkategoriEl.innerHTML = '<option value="">Semua Subkategori</option>';
                options.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    if (sub === selectedSubkategori) {
                        option.selected = true;
                    }
                    subkategoriEl.appendChild(option);
                });
                subkategoriEl.disabled = !kategori;
            }

            kategoriEl.addEventListener('change', updateSubkategoriOptions);
            updateSubkategoriOptions();
        </script>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class=" text-center">
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-10">No</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-14">Foto</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-36">Nama Barang</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Kategori</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Harga/Hari</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-14 text-center">Stok</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Status</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @forelse ($barangs as $barang)
                        @php
                            $fotoUtama = collect($barang->gambar_barang)->first();
                            $labelKategori = $barang->kategori_barang === 'Alat Camping' ? 'Camping' : $barang->kategori_barang;
                            $kategoriClass = match ($barang->kategori_barang) {
                                'Kamera' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-700'],
                                'Alat Camping' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-800'],
                                default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600'],
                            };
                            $statusClass = match ($barang->status_barang) {
                                'Tersedia' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-800', 'dot' => 'bg-emerald-500'],
                                'Sedikit' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-800', 'dot' => 'bg-amber-500'],
                                default => ['bg' => 'bg-red-50', 'text' => 'text-red-800', 'dot' => 'bg-red-400'],
                            };
                        @endphp
                        
                        
                        <tr class="hover:bg-gray-50 transition">  
                            <td class="px-3 py-3 text-gray-400 text-xs">{{ $barangs->firstItem() + $loop->index }}</td>
                            <td class="px-3 py-3">
                                <div class="w-20 h-20 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center overflow-hidden mx-auto">
                                    @if ($fotoUtama)
                                        <img src="{{ asset('storage/' . $fotoUtama) }}" alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <span class="text-xs text-gray-400">No img</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 py-3 font-medium text-gray-800 truncate" title="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</td>
                            <td class="px-3 py-3">
                                <span class="inline-block px-2 py-0.5 text-xs font-medium {{ $kategoriClass['bg'] }} {{ $kategoriClass['text'] }} rounded">{{ $labelKategori }}</span>
                            </td>
                            <td class="px-3 py-3 text-gray-700 text-xs">Rp {{ number_format($barang->harga_perhari, 0, ',', '.') }}</td>
                            <td class="px-3 py-3 text-center font-medium text-gray-800">{{ $barang->stok }}</td>
                            <td class="px-3 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full {{ $statusClass['bg'] }} {{ $statusClass['text'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $statusClass['dot'] }} inline-block"></span>
                                    {{ $barang->status_barang }}
                                </span>
                            </td>
                            <td class="px-3 py-3">
                                <form action="{{ route('Detail_Barang') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">

                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">

                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" viewBox="0 0 24 24">

                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>

                                        Detail
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-10 text-center text-sm text-gray-500">
                                Belum ada barang di inventaris.
                                <a href="{{ route('Tambah_Barang') }}" class="text-emerald-700 font-medium hover:underline">Tambah barang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <div class="flex flex-col items-center gap-3 border-t border-gray-100 bg-gray-50 px-4 py-3">
                <p class="text-xs text-gray-500 text-center">
                    @if ($barangs->total() > 0)
                        Menampilkan {{ $barangs->firstItem() }}-{{ $barangs->lastItem() }} dari {{ $barangs->total() }} barang
                    @else
                        Tidak ada barang
                    @endif
                </p>
                {{ $barangs->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
