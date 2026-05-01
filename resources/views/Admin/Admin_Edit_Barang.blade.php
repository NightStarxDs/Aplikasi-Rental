<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Edit Barang</h1>
                <p class="mt-1 text-sm text-gray-500">Perbarui informasi barang pada inventaris</p>
            </div>
            <span class="hidden rounded-full border border-amber-100 bg-amber-50 px-3 py-1 text-xs font-medium text-amber-700 sm:inline-flex">
                Mode Perubahan Data
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto px-4">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 sm:p-6"
                x-data="{
                    photoPreview: '{{ data_get($barang ?? null, 'foto') ? asset(data_get($barang, 'foto')) : '' }}'
                }">

                <form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Nama Barang</label>
                            <input type="text" name="nama_barang" placeholder="Contoh: Canon EOS R50"
                                value="{{ old('nama_barang', data_get($barang ?? null, 'nama_barang')) }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            @error('nama_barang')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Deskripsi Barang</label>
                            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat barang..."
                                class="w-full resize-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">{{ old('deskripsi', data_get($barang ?? null, 'deskripsi')) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Kategori</label>
                            <select name="kategori"
                                class="w-full cursor-pointer appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                                <option value="">Pilih Kategori</option>
                                <option value="kamera" {{ old('kategori', data_get($barang ?? null, 'kategori')) == 'kamera' ? 'selected' : '' }}>Kamera</option>
                                <option value="camping" {{ old('kategori', data_get($barang ?? null, 'kategori')) == 'camping' ? 'selected' : '' }}>Camping</option>
                            </select>
                            @error('kategori')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Jumlah Barang</label>
                            <input type="number" name="jumlah" min="0" placeholder="0"
                                value="{{ old('jumlah', data_get($barang ?? null, 'jumlah')) }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            @error('jumlah')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Harga (Per Hari)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">Rp</span>
                                <input type="number" name="harga" min="0" placeholder="0"
                                    value="{{ old('harga', data_get($barang ?? null, 'harga')) }}"
                                    class="w-full rounded-lg border border-gray-200 bg-white py-2 pl-9 pr-3 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                            @error('harga')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Foto Barang</label>
                            <label
                                class="group flex w-full cursor-pointer flex-col items-center justify-center gap-1.5 rounded-lg border border-dashed border-gray-300 bg-white py-4 transition hover:border-emerald-500">
                                <svg class="h-5 w-5 text-gray-400 transition group-hover:text-emerald-500" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                                <span class="text-xs text-gray-400 transition group-hover:text-emerald-600">Klik untuk mengganti foto</span>
                                <input type="file" name="foto" accept="image/*" class="hidden"
                                    @change="const file = $event.target.files[0]; if (file) { photoPreview = URL.createObjectURL(file); }">
                            </label>
                            @error('foto')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                                <div class="border-b border-gray-100 px-3 py-2 text-xs font-medium text-gray-500">
                                    Preview Foto
                                </div>
                                <div class="flex h-52 items-center justify-center bg-gray-100">
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" alt="Preview foto barang"
                                            class="h-full w-full object-cover">
                                    </template>
                                    <template x-if="!photoPreview">
                                        <div class="text-center text-xs text-gray-400">
                                            Belum ada foto terpilih
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </form>
            </div>
        </div><div class="flex items-center justify-between gap-2 border-gray-200 pt-5">
                        <a href="{{ route('Inventaris') }}"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-800">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                            Kembali
                        </a>

                        <div class="flex items-center gap-2">
                            <button type="reset"
                                class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-medium text-amber-700 transition hover:bg-amber-100">
                                Reset Perubahan
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-emerald-600 bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 active:scale-[0.99]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V7l5-4h8l5 4v12a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
    </div>
</x-app-layout>
