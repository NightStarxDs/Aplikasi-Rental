<x-app3-layout>

        <div class="pt-[30px] px-6 pb-6 space-y-4">

        {{-- Pilih Waktu --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                Pilih Waktu Penyewaan dan Pengembalian
            </p>

            {{-- Tab Kategori Durasi --}}
            <div class="flex items-center gap-2 mb-4">
                <button id="tab-jam" onclick="gantiKategori('jam')"
                    class="px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-emerald-700 text-white border-emerald-700">
                    Per Jam
                </button>
                <button id="tab-hari" onclick="gantiKategori('hari')"
                    class="px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-white text-gray-500 border-gray-200 hover:border-emerald-400 hover:text-emerald-600">
                    Per Hari
                </button>
            </div>

            {{-- Input Per Jam --}}
            <div id="panel-jam" class="grid grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Sewa</label>
                    <input type="date" id="jam_tgl" onchange="hitungDurasi()"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Jam Mulai</label>
                    <input type="time" id="jam_mulai" onchange="hitungDurasi()"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
                <div class="col-span-2 flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">
                        Durasi (Jam)
                        <span class="text-gray-400 font-normal ml-1">Maks. 23 jam — lebih dari itu gunakan Per Hari</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <button onclick="ubahDurasiJam(-1)"
                            class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition font-bold text-base">−</button>
                        <span id="durasi-jam-val" class="text-lg font-semibold text-gray-800 w-8 text-center">1</span>
                        <button onclick="ubahDurasiJam(1)"
                            class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition font-bold text-base">+</button>
                        <span class="text-sm text-gray-400">jam</span>
                    </div>
                </div>
            </div>

            {{-- Input Per Hari --}}
            <div id="panel-hari" class="hidden grid grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Mulai Sewa</label>
                    <input type="date" id="hari_tgl_mulai" onchange="hitungDurasi()"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Kembali</label>
                    <input type="date" id="hari_tgl_kembali" onchange="hitungDurasi()"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
            </div>

            {{-- Warning --}}
            <div id="warning-jam" class="hidden mt-3 px-3 py-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-xs text-yellow-700 font-medium">
                    ⚠ Durasi melebihi 23 jam. Silakan gunakan kategori <strong>Per Hari</strong> untuk sewa lebih dari 1 hari.
                </p>
            </div>

            {{-- Info Durasi --}}
            <div id="info-durasi" class="hidden mt-3 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-xs text-emerald-700 font-medium">
                    Durasi sewa: <span id="label-durasi" class="font-bold"></span>
                </p>
            </div>
        </div>

        {{-- Tabel Produk --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            {{-- Header Tabel --}}
            <div class="grid grid-cols-12 gap-2 px-4 py-3 bg-gray-50 border-b border-gray-200">
                <div class="col-span-1 flex items-center">
                    <input type="checkbox" id="pilihSemua" onchange="toggleSemua(this)"
                        class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                </div>
                <div class="col-span-4 text-xs font-medium text-gray-500">Produk</div>
                <div class="col-span-2 text-xs font-medium text-gray-500 text-center">Harga Satuan</div>
                <div class="col-span-2 text-xs font-medium text-gray-500 text-center">Kuantitas</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Durasi</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Total</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Aksi</div>
            </div>

            {{-- Item 1 --}}
            <div class="item-row grid grid-cols-12 gap-2 px-4 py-4 border-b border-gray-100 items-center hover:bg-gray-50 transition" data-harga="25000">
                <div class="col-span-1">
                    <input type="checkbox" onchange="updateTotal()" class="item-check w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                </div>
                <div class="col-span-4 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('images/canon.png') }}" alt="Canon EOS R50" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Canon EOS R50</p>
                        <p class="text-xs text-gray-400">Kamera</p>
                    </div>
                </div>
                <div class="col-span-2 text-center">
                    <p class="text-sm font-medium text-gray-700">Rp 25.000</p>
                    <p class="text-xs text-gray-400 satuan-label">/jam</p>
                </div>
                <div class="col-span-2 flex items-center justify-center gap-1">
                    <button onclick="ubahQty(this, -1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">−</button>
                    <span class="qty w-7 text-center text-sm font-medium text-gray-800">1</span>
                    <button onclick="ubahQty(this, 1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">+</button>
                </div>
                <div class="col-span-1 text-center">
                    <span class="durasi-label text-xs font-medium text-gray-600">-</span>
                </div>
                <div class="col-span-1 text-center">
                    <p class="subtotal text-sm font-semibold text-emerald-700">Rp 0</p>
                </div>
                <div class="col-span-1 flex justify-center">
                    <button onclick="hapusItem(this)" class="w-7 h-7 flex items-center justify-center bg-red-50 hover:bg-red-100 rounded-lg text-red-500 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="item-row grid grid-cols-12 gap-2 px-4 py-4 border-b border-gray-100 items-center hover:bg-gray-50 transition" data-harga="50000">
                <div class="col-span-1">
                    <input type="checkbox" onchange="updateTotal()" class="item-check w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                </div>
                <div class="col-span-4 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                         <img src="{{ asset('images/tendadome.jpg') }}" alt="Tenda Dome 4P" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Tenda Dome 4P</p>
                        <p class="text-xs text-gray-400">Camping</p>
                    </div>
                </div>
                <div class="col-span-2 text-center">
                    <p class="text-sm font-medium text-gray-700">Rp 50.000</p>
                    <p class="text-xs text-gray-400 satuan-label">/jam</p>
                </div>
                <div class="col-span-2 flex items-center justify-center gap-1">
                    <button onclick="ubahQty(this, -1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">−</button>
                    <span class="qty w-7 text-center text-sm font-medium text-gray-800">1</span>
                    <button onclick="ubahQty(this, 1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">+</button>
                </div>
                <div class="col-span-1 text-center">
                    <span class="durasi-label text-xs font-medium text-gray-600">-</span>
                </div>
                <div class="col-span-1 text-center">
                    <p class="subtotal text-sm font-semibold text-emerald-700">Rp 0</p>
                </div>
                <div class="col-span-1 flex justify-center">
                    <button onclick="hapusItem(this)" class="w-7 h-7 flex items-center justify-center bg-red-50 hover:bg-red-100 rounded-lg text-red-500 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="item-row grid grid-cols-12 gap-2 px-4 py-4 items-center hover:bg-gray-50 transition" data-harga="15000">
                <div class="col-span-1">
                    <input type="checkbox" onchange="updateTotal()" class="item-check w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                </div>
                <div class="col-span-4 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('images/sleapingbag.jpg') }}" alt="Sleeping Bag" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Sleeping Bag</p>
                        <p class="text-xs text-gray-400">Camping</p>
                    </div>
                </div>
                <div class="col-span-2 text-center">
                    <p class="text-sm font-medium text-gray-700">Rp 15.000</p>
                    <p class="text-xs text-gray-400 satuan-label">/jam</p>
                </div>
                <div class="col-span-2 flex items-center justify-center gap-1">
                    <button onclick="ubahQty(this, -1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">−</button>
                    <span class="qty w-7 text-center text-sm font-medium text-gray-800">1</span>
                    <button onclick="ubahQty(this, 1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">+</button>
                </div>
                <div class="col-span-1 text-center">
                    <span class="durasi-label text-xs font-medium text-gray-600">-</span>
                </div>
                <div class="col-span-1 text-center">
                    <p class="subtotal text-sm font-semibold text-emerald-700">Rp 0</p>
                </div>
                <div class="col-span-1 flex justify-center">
                    <button onclick="hapusItem(this)" class="w-7 h-7 flex items-center justify-center bg-red-50 hover:bg-red-100 rounded-lg text-red-500 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Footer Tabel --}}
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="pilihSemuaBottom" onchange="toggleSemua(this)"
                        class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                    <label for="pilihSemuaBottom" class="text-sm font-medium text-gray-600 cursor-pointer">
                        Pilih Semua Barang
                    </label>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-xs text-gray-400" id="label-produk">Total (0 Produk)</p>
                        <p class="text-sm font-bold text-emerald-700" id="grand-total">Rp 0</p>
                    </div>
                    <a href="{{ route('Checkout') }}" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-emerald-700 hover:bg-emerald-800 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Checkout
                    </a>
                </div>
            </div>

        </div>

        {{-- Tombol Kembali --}}
        <div class="pt-1">
            <a href="{{ route('Penjualan') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>

    </div>

    <script>
        let kategori  = 'jam'; // 'jam' atau 'hari'
        let durasiJam = 1;     // durasi dalam jam (mode jam)
        let totalJam  = 0;     // total jam yang dipakai untuk hitung harga

        // Ganti tab kategori
        function gantiKategori(kat) {
            kategori = kat;

            const panelJam  = document.getElementById('panel-jam');
            const panelHari = document.getElementById('panel-hari');
            const tabJam    = document.getElementById('tab-jam');
            const tabHari   = document.getElementById('tab-hari');

            if (kat === 'jam') {
                panelJam.classList.remove('hidden');
                panelHari.classList.add('hidden');
                tabJam.className  = 'px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-emerald-700 text-white border-emerald-700';
                tabHari.className = 'px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-white text-gray-500 border-gray-200 hover:border-emerald-400 hover:text-emerald-600';
            } else {
                panelHari.classList.remove('hidden');
                panelJam.classList.add('hidden');
                tabHari.className = 'px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-emerald-700 text-white border-emerald-700';
                tabJam.className  = 'px-4 py-1.5 text-xs font-medium rounded-lg border transition bg-white text-gray-500 border-gray-200 hover:border-emerald-400 hover:text-emerald-600';
            }

            // Reset warning & info
            document.getElementById('warning-jam').classList.add('hidden');
            document.getElementById('info-durasi').classList.add('hidden');
            totalJam = 0;
            updateSatuanLabel();
            updateTotal();
        }

        // Ubah durasi jam dengan tombol +/-
        function ubahDurasiJam(n) {
            const next = durasiJam + n;

            if (next > 23) {
                // Tampilkan warning
                document.getElementById('warning-jam').classList.remove('hidden');
                return;
            }

            if (next < 1) return;

            document.getElementById('warning-jam').classList.add('hidden');
            durasiJam = next;
            document.getElementById('durasi-jam-val').textContent = durasiJam;
            hitungDurasi();
        }

        // Hitung durasi total (jam)
        function hitungDurasi() {
            if (kategori === 'jam') {
                totalJam = durasiJam;
                tampilkanInfo(`${durasiJam} Jam`);

            } else {
                const tglMulai   = document.getElementById('hari_tgl_mulai').value;
                const tglKembali = document.getElementById('hari_tgl_kembali').value;

                if (!tglMulai || !tglKembali) return;

                const mulai   = new Date(tglMulai);
                const kembali = new Date(tglKembali);
                const selisihMs = kembali - mulai;

                if (selisihMs <= 0) {
                    document.getElementById('info-durasi').classList.add('hidden');
                    totalJam = 0;
                    updateTotal();
                    return;
                }

                const hari = Math.ceil(selisihMs / (1000 * 60 * 60 * 24));
                totalJam   = hari * 24;
                tampilkanInfo(`${hari} Hari`);
            }

            updateSatuanLabel();
            updateTotal();
        }

        // Tampilkan info durasi + update label tiap baris
        function tampilkanInfo(teks) {
            document.getElementById('label-durasi').textContent = teks;
            document.getElementById('info-durasi').classList.remove('hidden');
            document.querySelectorAll('.durasi-label').forEach(el => {
                el.textContent = teks;
            });
        }

        // Update label /jam atau /hari di kolom harga satuan
        function updateSatuanLabel() {
            const teks = kategori === 'jam' ? '/jam' : '/hari';
            document.querySelectorAll('.satuan-label').forEach(el => {
                el.textContent = teks;
            });
        }

        // Ubah kuantitas item
        function ubahQty(btn, n) {
            const row = btn.closest('.item-row');
            const el  = row.querySelector('.qty');
            const val = parseInt(el.textContent) + n;
            if (val >= 1 && val <= 10) {
                el.textContent = val;
                updateTotal();
            }
        }

        // Hapus item
        function hapusItem(btn) {
            if (confirm('Hapus barang ini dari keranjang?')) {
                btn.closest('.item-row').remove();
                updateTotal();
            }
        }

        // Pilih semua
        function toggleSemua(el) {
            document.querySelectorAll('.item-check').forEach(cb => cb.checked = el.checked);
            document.getElementById('pilihSemua').checked       = el.checked;
            document.getElementById('pilihSemuaBottom').checked = el.checked;
            updateTotal();
        }

        // Update total harga
        function updateTotal() {
            let total  = 0;
            let jumlah = 0;

            document.querySelectorAll('.item-row').forEach(row => {
                const harga    = parseInt(row.dataset.harga);
                const qty      = parseInt(row.querySelector('.qty').textContent);
                const checked  = row.querySelector('.item-check').checked;
                const subtotal = harga * qty * (totalJam || 0);

                row.querySelector('.subtotal').textContent =
                    subtotal > 0 ? 'Rp ' + subtotal.toLocaleString('id-ID') : 'Rp 0';

                if (checked) {
                    total  += subtotal;
                    jumlah += 1;
                }
            });

            document.getElementById('grand-total').textContent  = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('label-produk').textContent = `Total (${jumlah} Produk)`;
        }
    </script>

</x-app3-layout>