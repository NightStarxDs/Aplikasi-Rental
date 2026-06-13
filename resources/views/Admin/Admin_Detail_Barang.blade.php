<x-app-layout>
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
        $statusClass = match ($barang->status_barang) {
            'Tersedia' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-800', 'dot' => 'bg-emerald-500'],
            'Sedikit' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-800', 'dot' => 'bg-amber-500'],
            default => ['bg' => 'bg-red-50', 'text' => 'text-red-800', 'dot' => 'bg-red-400'],
        };
    @endphp

    <div class="py-6 px-6 space-y-4" x-data="{ activeFoto: @js($fotoUtama) }">

        {{-- Card Info Utama --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 flex gap-5">

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

                @if ($fotos->count() > 1)
                    <div class="grid grid-cols-5 gap-1.5 max-w-[295px]">
                        @foreach ($fotos as $foto)
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

            {{-- Info --}}
            <div class="flex flex-col py-[65px] gap-3">
                <span class="inline-block px-2 py-0.5 text-xs font-medium bg-white border border-gray-200 rounded text-gray-500 w-fit">
                    {{ $barang->labelKategori() }}
                </span>
                <p class="text-xl font-semibold text-gray-800">{{ $barang->nama_barang }}</p>
                <p class="text-sm text-gray-500">{{ $barang->subkategori_barang }}</p>
                <p class="text-xl font-semibold text-emerald-700">
                    Rp {{ number_format($barang->harga_perhari, 0, ',', '.') }}
                    <span class="text-base font-normal text-gray-400">/ Hari</span>
                </p>
                <p class="text-base font-medium text-gray-600">
                    Rp {{ number_format($barang->harga_perjam, 0, ',', '.') }}
                    <span class="text-sm font-normal text-gray-400">/ Jam</span>
                </p>
            </div>

        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Subkategori</p>
                <p class="text-base font-semibold text-gray-800">{{ $barang->subkategori_barang }}</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Stok Tersedia</p>
                <p class="text-base font-semibold text-gray-800">{{ $barang->stok }} Unit</p>
            </div>
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Status Barang</p>
                <span class="inline-flex items-center gap-1 px-2 py-1.5 text-xs font-medium rounded-full {{ $statusClass['bg'] }} {{ $statusClass['text'] }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $statusClass['dot'] }} inline-block"></span>
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

        @if ($barang->catatan_kondisi_barang)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                <h2 class="text-sm font-semibold text-gray-700 mb-2">Catatan Kondisi Barang</h2>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $barang->catatan_kondisi_barang }}</p>
            </div>
        @endif

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-between pt-1">

        {{-- Tombol Kembali (Kiri) --}}
        <a href="{{ route('Inventaris') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">

            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6"/>
            </svg>

            Kembali
        </a>

        {{-- Tombol Kanan --}}
        <div class="flex items-center gap-2">

            {{-- Tombol Hapus --}}
            <form action="{{ route('barang.destroy', $barang->kode_barang) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    onclick="return confirm('Yakin ingin menghapus barang ini?')"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-red-50 text-red-700 border border-red-100 rounded-lg hover:bg-red-100 transition">

                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                    </svg>

                    Hapus
                </button>
            </form>

            {{-- Tombol Edit --}}
            <form action="{{ route('Edit_Barang') }}" method="POST">
                @csrf
                <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">
                <button type="submit"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100 rounded-lg hover:bg-blue-100 transition">

                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>

                Edit
                </button>
            </form>
        </div>

</div>
</x-app-layout>
