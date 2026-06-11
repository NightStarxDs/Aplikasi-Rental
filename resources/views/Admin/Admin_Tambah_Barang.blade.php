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

                <form action="{{ route('Tambah_Barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nama Barang --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-xl font-medium text-gray-500">Nama Barang</label>
                            <input type="text" name="nama_barang"
                                placeholder="Masukkan Nama Barang"
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
                            {{-- Kategori --}}
                            <select name="kategori" id="kategori"   {{-- ← tambahkan id="kategori" --}}
                                class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition appearance-none cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                <option value="kamera" {{ old('kategori') == 'kamera' ? 'selected' : '' }}>Kamera</option>
                                <option value="camping" {{ old('kategori') == 'camping' ? 'selected' : '' }}>Camping</option>
                            </select>
                            @error('kategori')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subkategori <span class="text-red-500">*</span></label>
                            <select name="subkategori" id="subkategori" required
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                                <option value="">-- Pilih Kategori Utama Dulu --</option>
                            </select>
                            @error('subkategori')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
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
                                <input type="number" name="harga" id="harga" min="0"
                                    placeholder="0"
                                    value="{{ old('harga') }}"
                                    class="w-full pl-9 pr-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                            </div>
                            @error('harga')
                                <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga / Jam</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">Rp</span>
                                <input type="text" id="harga_perjam_display" readonly
                                    placeholder="Otomatis dihitung"
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                            </div>
                            <p class="mt-1 text-xs text-gray-400">Dihitung otomatis dari Harga/Hari ÷ 24</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kondisi Barang</label>
                            <textarea name="catatan_kondisi_barang" rows="3"
                                placeholder="Contoh: Kondisi baik, ada goresan kecil di body..."
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 resize-none">{{ old('catatan_kondisi') }}</textarea>
                        </div>

                        {{-- Foto (5 gambar, input terpisah) --}}
                        <div class="md:col-span-2 flex flex-col gap-3">
                            <div>
                                <label class="text-lg font-medium text-gray-500">Foto Barang</label>
                                <p class="text-xs text-gray-400 mt-0.5">Unggah hingga 5 foto. Foto 1 akan ditampilkan sebagai foto utama.</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="flex flex-col gap-1">
                                        <label class="text-sm font-medium text-gray-500">
                                            {{ $i === 1 ? 'Foto Utama' : 'Foto ' . $i }}
                                        </label>
                                        <label class="relative flex flex-col items-center justify-center gap-1.5 w-full min-h-[140px] border border-dashed border-gray-300 rounded-lg bg-white cursor-pointer hover:border-emerald-500 transition overflow-hidden"
                                            style="background-size: cover; background-position: center; background-repeat: no-repeat;">
                                            <div class="upload-placeholder flex flex-col items-center justify-center gap-1 text-center px-3">
                                                <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-500 transition" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                    <polyline points="17 8 12 3 7 8"/>
                                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                                </svg>
                                                <span class="text-xs text-gray-400 group-hover:text-emerald-600 transition text-center px-2">Klik untuk unggah</span>
                                            </div>
                                            <input type="file" name="foto_{{ $i }}" accept="image/*" class="hidden foto-input" data-preview-target="foto-preview-{{ $i }}">
                                        </label>
                                        <div id="foto-preview-{{ $i }}" class="min-h-[48px] px-3 py-2 text-xs text-gray-500 border border-dashed border-gray-200 rounded-lg bg-slate-50 truncate">
                                            Belum ada file dipilih.
                                        </div>
                                        @error('foto_' . $i)
                                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
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

    <script>
    const subkategoriMap = {
        kamera: ['DSLR Cam','Mirrorless Cam','Video Cam','Action Cam','Lensa','Aksesoris Kamera','Lighting','Audio'],
        camping: ['Tenda','Peralatan Tidur','Peralatan Memasak','Penerangan','Power'],
    };

    const kategoriEl   = document.getElementById('kategori');
    const subEl        = document.getElementById('subkategori');
    const hargaEl      = document.getElementById('harga');        // input harga/hari
    const hargaJamEl   = document.getElementById('harga_perjam_display');

    // Populate subkategori
    function updateSubkategori() {
        const val = kategoriEl.value;
        subEl.innerHTML = '<option value="">-- Pilih Subkategori --</option>';
        (subkategoriMap[val] || []).forEach(s => {
            const opt = document.createElement('option');
            opt.value = s;
            opt.textContent = s;
            // Pertahankan nilai lama saat validasi gagal
            if (s === '{{ old('subkategori') }}') opt.selected = true;
            subEl.appendChild(opt);
        });
    }

    // Hitung harga/jam
    function hitungHargaJam() {
        const harga = parseFloat(hargaEl.value) || 0;
        const perjam = harga / 24;
        hargaJamEl.value = perjam > 0
            ? 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(perjam))
            : '';
    }

    kategoriEl.addEventListener('change', updateSubkategori);
    hargaEl.addEventListener('input', hitungHargaJam);

    document.querySelectorAll('.foto-input').forEach(input => {
        const previewId = input.dataset.previewTarget;
        const previewEl = document.getElementById(previewId);
        const uploadLabel = input.closest('label');
        const placeholder = uploadLabel?.querySelector('.upload-placeholder');

        input.addEventListener('change', () => {
            if (!previewEl || !uploadLabel) return;

            const file = input.files?.[0];
            if (!file) {
                previewEl.textContent = 'Belum ada file dipilih.';
                uploadLabel.style.backgroundImage = 'none';
                if (placeholder) placeholder.style.opacity = '1';
                return;
            }

            previewEl.textContent = file.name;

            if (file.type.startsWith('image/')) {
                const imageUrl = URL.createObjectURL(file);
                uploadLabel.style.backgroundImage = `url('${imageUrl}')`;
                if (placeholder) placeholder.style.opacity = '0';
                uploadLabel.style.backgroundColor = 'transparent';
                uploadLabel.style.backgroundBlendMode = 'normal';

                // clean up object URL after load
                const img = new Image();
                img.onload = () => URL.revokeObjectURL(imageUrl);
                img.src = imageUrl;
            } else {
                uploadLabel.style.backgroundImage = 'none';
                if (placeholder) placeholder.style.opacity = '1';
            }
        });
    });

    // Jalankan saat load (untuk kondisi old() saat validasi gagal)
    if (kategoriEl.value) updateSubkategori();
    if (hargaEl.value)    hitungHargaJam();
    </script>
</x-app-layout>