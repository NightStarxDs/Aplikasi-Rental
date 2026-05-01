<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Isi detail barang baru untuk ditambahkan ke inventaris</p>
            </div>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="l mx-auto px-4">

            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">

                <form action="{{ route('Tambah_Barang') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nama Barang --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-xl font-medium text-gray-500">Nama Barang</label>
                            <input type="text" name="nama_barang"
                                placeholder="Contoh: Canon EOS R50"
                                value="{{ old('nama_barang') }}"
                                class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                            @error('nama_barang')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-xl font-medium text-gray-500">Deskripsi Barang</label>
                            <textarea name="deskripsi" rows="2"
                                placeholder="Deskripsi singkat barang..."
                                class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition resize-none">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-xl font-medium text-gray-500">Kategori</label>
                            <select name="kategori"
                                class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition appearance-none cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                <option value="kamera" {{ old('kategori') == 'kamera' ? 'selected' : '' }}>Kamera</option>
                                <option value="camping" {{ old('kategori') == 'camping' ? 'selected' : '' }}>Camping</option>
                            </select>
                            @error('kategori')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-lg font-medium text-gray-500">Jumlah Barang</label>
                            <input type="number" name="jumlah" min="0"
                                placeholder="0"
                                value="{{ old('jumlah') }}"
                                class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                            @error('jumlah')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-lg font-medium text-gray-500">Harga (Per Hari)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">Rp</span>
                                <input type="number" name="harga" min="0"
                                    placeholder="0"
                                    value="{{ old('harga') }}"
                                    class="w-full pl-9 pr-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                            </div>
                            @error('harga')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-lg font-medium text-gray-500">Foto Barang</label>
                            <label class="flex flex-col items-center justify-center gap-1.5 w-full border border-dashed border-gray-300 rounded-lg py-4 bg-white cursor-pointer hover:border-emerald-500 transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-500 transition" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                                <span class="text-xs text-gray-400 group-hover:text-emerald-600 transition">Klik untuk unggah foto</span>
                                <input type="file" name="foto" accept="image/*" class="hidden">
                            </label>
                            @error('foto')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200">
                        <a href="{{ route('Inventaris') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 bg-transparent border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                            Kembali
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-700 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Tambah Barang
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>