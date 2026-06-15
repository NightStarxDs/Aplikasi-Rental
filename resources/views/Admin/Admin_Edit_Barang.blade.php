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

    @php
        $kategoriForm   = old('kategori', $barang->kategori_barang === 'Alat Camping' ? 'camping' : 'kamera');
        $subkategoriForm = old('subkategori', $barang->subkategori_barang);
        $fotosLama      = collect($barang->gambar_barang ?? []);
    @endphp

    <div class="py-6">
        <div class="mx-auto px-4">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 sm:p-6">
                <form action="{{ route('Edit_Barang.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        {{-- Nama Barang --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Nama Barang</label>
                            <input type="text" name="nama_barang" placeholder="Contoh: Canon EOS R50"
                                value="{{ old('nama_barang', $barang->nama_barang) }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            @error('nama_barang')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Deskripsi Barang</label>
                            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat barang..."
                                class="w-full resize-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">{{ old('deskripsi', $barang->deskripsi_barang) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="w-full cursor-pointer appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                                <option value="">Pilih Kategori</option>
                                <option value="kamera" {{ $kategoriForm === 'kamera' ? 'selected' : '' }}>Kamera</option>
                                <option value="camping" {{ $kategoriForm === 'camping' ? 'selected' : '' }}>Camping</option>
                            </select>
                            @error('kategori')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Subkategori --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Subkategori <span class="text-red-500">*</span></label>
                            <select name="subkategori" id="subkategori"
                                class="w-full cursor-pointer appearance-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                                <option value="">-- Pilih Kategori Utama Dulu --</option>
                            </select>
                            @error('subkategori')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Jumlah Barang</label>
                            <input type="number" name="jumlah" min="0" placeholder="0"
                                value="{{ old('jumlah', $barang->stok) }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            @error('jumlah')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga Per Hari --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Harga (Per Hari)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">Rp</span>
                                <input type="number" name="harga" id="harga" min="0" placeholder="0"
                                    value="{{ old('harga', $barang->harga_perhari) }}"
                                    class="w-full rounded-lg border border-gray-200 bg-white py-2 pl-9 pr-3 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                            </div>
                            @error('harga')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga Per Jam (readonly) --}}
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Harga / Jam</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">Rp</span>
                                <input type="text" id="harga_perjam_display" readonly
                                    placeholder="Otomatis dihitung"
                                    class="w-full rounded-lg border border-gray-200 bg-gray-100 py-2 pl-9 pr-3 text-sm text-gray-500 cursor-not-allowed focus:outline-none">
                            </div>
                            <p class="mt-0.5 text-xs text-gray-400">Dihitung otomatis dari Harga/Hari ÷ 24</p>
                        </div>

                        {{-- Catatan Kondisi Barang --}}
                        <div class="md:col-span-2 flex flex-col gap-1">
                            <label class="text-sm font-medium text-gray-600">Catatan Kondisi Barang</label>
                            <textarea name="catatan_kondisi_barang" rows="3"
                                placeholder="Contoh: Kondisi baik, ada goresan kecil di body..."
                                class="w-full resize-none rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 placeholder-gray-400 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">{{ old('catatan_kondisi_barang', $barang->catatan_kondisi_barang) }}</textarea>
                            @error('catatan_kondisi_barang')
                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Foto (5 gambar) --}}
                        <div class="md:col-span-2 flex flex-col gap-3">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Foto Barang</label>
                                <p class="mt-0.5 text-xs text-gray-400">Klik ikon 🗑 untuk menandai foto yang ingin dihapus. Unggah file baru untuk mengganti atau menambah foto.</p>
                            </div>

                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    @php $fotoLama = $fotosLama->get($i - 1); @endphp
                                    <div class="flex flex-col gap-1" id="foto-slot-{{ $i }}">
                                        <label class="text-sm font-medium text-gray-500">
                                            {{ $i === 1 ? 'Foto Utama' : 'Foto ' . $i }}
                                        </label>

                                        {{-- Hidden input penanda hapus --}}
                                        <input type="hidden" name="hapus_foto_{{ $i }}" value="0" id="hapus_foto_{{ $i }}_input">

                                        @if ($fotoLama)
                                            {{-- Gambar lama + tombol hapus --}}
                                            <div class="relative h-28 overflow-hidden rounded-lg border border-gray-200 bg-gray-50"
                                                 id="existing-foto-{{ $i }}">
                                                <img src="{{ asset('storage/' . $fotoLama) }}"
                                                     alt="Foto {{ $i }}"
                                                     class="h-full w-full object-cover"
                                                     id="existing-img-{{ $i }}">

                                                {{-- Overlay "Akan Dihapus" --}}
                                                <div id="hapus-overlay-{{ $i }}"
                                                     class="absolute inset-0 hidden items-center justify-center bg-red-500/75 rounded-lg backdrop-blur-[1px]">
                                                    <div class="flex flex-col items-center gap-1">
                                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                                        </svg>
                                                        <span class="text-white text-xs font-semibold">Akan Dihapus</span>
                                                        <button type="button" onclick="toggleHapusFoto({{ $i }})"
                                                            class="mt-0.5 rounded bg-white/30 px-2 py-0.5 text-[10px] font-medium text-white hover:bg-white/50 transition">
                                                            Batalkan
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- Tombol Hapus --}}
                                                <button type="button" onclick="toggleHapusFoto({{ $i }})"
                                                    id="hapus-btn-{{ $i }}"
                                                    title="Hapus foto ini"
                                                    class="absolute top-1.5 right-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white shadow-md hover:bg-red-600 active:scale-95 transition">
                                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif

                                        {{-- Preview gambar BARU yang dipilih --}}
                                        <div id="new-preview-{{ $i }}" class="hidden relative h-28 overflow-hidden rounded-lg border-2 border-emerald-400 bg-gray-50 shadow-sm">
                                            <img id="new-preview-img-{{ $i }}" src="" alt="Preview baru"
                                                 class="h-full w-full object-cover">
                                            {{-- Badge "Baru" --}}
                                            <span class="absolute top-1.5 left-1.5 rounded-full bg-emerald-500 px-2 py-0.5 text-[10px] font-bold text-white shadow">
                                                Baru ✓
                                            </span>
                                            {{-- Tombol batal preview --}}
                                            <button type="button" onclick="batalPreview({{ $i }})"
                                                title="Batal pilih foto baru"
                                                class="absolute top-1.5 right-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-gray-700/80 text-white hover:bg-gray-900 active:scale-95 transition">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Area unggah --}}
                                        <label id="upload-label-{{ $i }}"
                                            class="group flex w-full cursor-pointer flex-col items-center justify-center gap-1.5 rounded-lg border border-dashed border-gray-300 bg-white py-3 transition hover:border-emerald-500">
                                            <svg class="h-5 w-5 text-gray-400 transition group-hover:text-emerald-500" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                <polyline points="17 8 12 3 7 8"/>
                                                <line x1="12" y1="3" x2="12" y2="15"/>
                                            </svg>
                                            <span id="upload-text-{{ $i }}" class="px-2 text-center text-xs text-gray-400 transition group-hover:text-emerald-600">
                                                {{ $fotoLama ? 'Ganti foto' : 'Unggah foto' }}
                                            </span>
                                            <input type="file" name="foto_{{ $i }}" id="foto_input_{{ $i }}"
                                                accept="image/*" class="hidden"
                                                onchange="previewFoto({{ $i }}, this)">
                                        </label>

                                        @error('foto_' . $i)
                                            <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="mt-6 flex items-center justify-between gap-2 border-t border-gray-200 pt-5">
                            <a href="{{ route('Inventaris') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">

                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>

                                Kembali
                            </a>
                        </a>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('Detail_Barang', ['kode_barang' => $barang->kode_barang]) }}"
                                class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-medium text-amber-700 transition hover:bg-amber-100">
                                Batal
                            </a>
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

                </form>
            </div>
        </div>
    </div>

    <script>
    const subkategoriMap = {
        kamera:  ['DSLR Cam','Mirrorless Cam','Video Cam','Action Cam','Lensa','Aksesoris Kamera','Lighting','Audio'],
        camping: ['Tenda','Peralatan Tidur','Peralatan Memasak','Penerangan','Power'],
    };

    // Nilai lama dari PHP (untuk pre-select saat load / validasi gagal)
    const oldSubkategori = '{{ $subkategoriForm }}';

    const kategoriEl  = document.getElementById('kategori');
    const subEl       = document.getElementById('subkategori');
    const hargaEl     = document.getElementById('harga');
    const hargaJamEl  = document.getElementById('harga_perjam_display');

    function updateSubkategori() {
        const val = kategoriEl.value;
        subEl.innerHTML = '<option value="">-- Pilih Subkategori --</option>';
        (subkategoriMap[val] || []).forEach(s => {
            const opt = document.createElement('option');
            opt.value       = s;
            opt.textContent = s;
            if (s === oldSubkategori) opt.selected = true;
            subEl.appendChild(opt);
        });
    }

    function hitungHargaJam() {
        const harga  = parseFloat(hargaEl.value) || 0;
        const perJam = Math.round(harga / 24);
        hargaJamEl.value = perJam > 0
            ? new Intl.NumberFormat('id-ID').format(perJam)
            : '';
    }

    kategoriEl.addEventListener('change', updateSubkategori);
    hargaEl.addEventListener('input', hitungHargaJam);

    // Jalankan saat halaman load agar data existing langsung tampil
    updateSubkategori();
    hitungHargaJam();

    // ─── Preview gambar baru yang dipilih ────────────────────────────────────
    function previewFoto(i, input) {
        if (!input.files || !input.files[0]) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const previewBox = document.getElementById('new-preview-' + i);
            const previewImg = document.getElementById('new-preview-img-' + i);
            previewImg.src   = e.target.result;
            previewBox.classList.remove('hidden');

            // Jika foto lama ditandai hapus, batalkan penghapusannya karena ada foto baru
            const hapusInput = document.getElementById('hapus_foto_' + i + '_input');
            if (hapusInput && hapusInput.value === '1') {
                setHapusFoto(i, false);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }

    // ─── Batal pilih foto baru ───────────────────────────────────────────────
    function batalPreview(i) {
        const previewBox = document.getElementById('new-preview-' + i);
        const fileInput  = document.getElementById('foto_input_' + i);

        if (previewBox) previewBox.classList.add('hidden');
        if (fileInput)  fileInput.value = '';
    }

    // ─── Toggle hapus foto lama ──────────────────────────────────────────────
    function toggleHapusFoto(i) {
        const hapusInput = document.getElementById('hapus_foto_' + i + '_input');
        if (!hapusInput) return;

        const isMarked = hapusInput.value === '1';
        setHapusFoto(i, !isMarked);
    }

    function setHapusFoto(i, mark) {
        const hapusInput = document.getElementById('hapus_foto_' + i + '_input');
        const overlay    = document.getElementById('hapus-overlay-' + i);
        const hapusBtn   = document.getElementById('hapus-btn-' + i);

        if (!hapusInput) return;

        hapusInput.value = mark ? '1' : '0';

        if (overlay) {
            overlay.classList.toggle('hidden', !mark);
            overlay.classList.toggle('flex', mark);
        }

        if (hapusBtn) {
            hapusBtn.classList.toggle('bg-red-500', !mark);
            hapusBtn.classList.toggle('hover:bg-red-600', !mark);
            hapusBtn.classList.toggle('bg-gray-400', mark);
            hapusBtn.classList.toggle('hover:bg-gray-500', mark);
        }

        // Jika ditandai hapus, bersihkan juga preview baru (jika ada)
        if (mark) {
            batalPreview(i);
        }
    }
    </script>

</x-app-layout>