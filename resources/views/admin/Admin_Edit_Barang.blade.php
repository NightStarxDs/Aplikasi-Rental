<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Edit Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail barang yang sudah ada</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                Inventaris Aktif
            </span>
        </div>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Nama Barang --}}
                    <div class="md:col-span-2 flex flex-col gap-1">
                        <label class="text-xl font-medium text-gray-500">Nama Barang</label>
                        <input type="text" name="nama_barang"
                            placeholder="Contoh: Canon EOS R50"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2 flex flex-col gap-1">
                        <label class="text-xl font-medium text-gray-500">Deskripsi Barang</label>
                        <textarea name="deskripsi" rows="2"
                            placeholder="Deskripsi singkat barang..."
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition resize-none"></textarea>
                    </div>

                    {{-- Kategori --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xl font-medium text-gray-500">Kategori Barang</label>
                        <select name="kategori"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition cursor-pointer">
                            <option value="">Pilih Kategori</option>
                            <option value="kamera">Kamera</option>
                            <option value="camping">Camping</option>
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-lg font-medium text-gray-500">Harga Barang (Per Hari)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">Rp</span>
                            <input type="number" name="harga" min="0"
                                placeholder="0"
                                class="w-full pl-9 pr-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                        </div>
                    </div>

                    {{-- Jumlah --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-lg font-medium text-gray-500">Jumlah Barang</label>
                        <input type="number" name="jumlah" min="0"
                            placeholder="0"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Foto --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-lg font-medium text-gray-500">Foto Barang</label>

                        {{-- Upload foto --}}
                        <label class="flex flex-col items-center justify-center gap-1.5 w-full border border-dashed border-gray-300 rounded-lg py-4 bg-white cursor-pointer hover:border-emerald-500 transition group"
                            onclick="this.querySelector('input').click()">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-500 transition" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            <span class="text-xs text-gray-400 group-hover:text-emerald-600 transition">Klik untuk unggah foto</span>
                            <input type="file" name="foto" accept="image/*" class="hidden"
                                onchange="previewFoto(this)">
                        </label>

                        {{-- Preview foto setelah dipilih --}}
                        <div id="preview-wrap" class="hidden flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-lg mt-1">
                            <img id="preview-img" src="#" class="w-9 h-9 rounded-lg object-cover">
                            <p id="preview-name" class="text-xs text-emerald-700"></p>
                        </div>
                    </div>

                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200">
                    <a href="{{ route('Inventaris') }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function previewFoto(input) {
            if (!input.files || !input.files[0]) return;

            const wrap   = document.getElementById('preview-wrap');
            const img    = document.getElementById('preview-img');
            const name   = document.getElementById('preview-name');
            const reader = new FileReader();

            reader.onload = e => {
                img.src          = e.target.result;
                name.textContent = input.files[0].name;
                wrap.classList.remove('hidden');
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>

</x-app-layout>