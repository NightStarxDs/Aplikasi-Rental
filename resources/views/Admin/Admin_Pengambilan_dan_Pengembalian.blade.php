<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengambilan & Pengembalian') }}
        </h2>
    </x-slot>
<body class="bg-gray-100 min-h-screen p-6">

    <div class=" mx-10 space-y-5">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Detail Transaksi</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap transaksi sewa barang</p>
            </div>
            <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-mono font-bold text-emerald-800">
                TRX001
            </span>
        </div>

        {{-- Detail Penyewa --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Detail Penyewa</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Nama Pelanggan</p>
                        <p class="text-sm font-medium text-gray-800">Benjamine Nyetanyahu</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Nomor Telepon</p>
                        <p class="text-sm font-medium text-gray-800">+1 9124 1042 19247</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Email</p>
                        <p class="text-sm font-medium text-gray-800">BenjamineNyetannyahu@Mail.com</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Sewa</p>
                        <p class="text-sm font-medium text-gray-800">2026-04-01</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Kembali</p>
                        <p class="text-sm font-medium text-gray-800">2026-04-05</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Durasi</p>
                        <p class="text-sm font-medium text-gray-800">4 Hari</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Produk --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Detail Produk</p>
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-2/5">Barang</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Harga Satuan</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Kuantitas</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Subtotal</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Canon EOS R50</p>
                                        <p class="text-xs text-gray-400">Kamera</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-500">Rp 25.000/jam</td>
                            <td class="px-4 py-3 text-center text-gray-500">1 Unit</td>
                            <td class="px-4 py-3 text-center font-medium text-gray-800">Rp 250.000</td>
                            <td class="px-4 py-3 text-center">
                                <span id="status-0" class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>Disewa
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Tenda Dome 4P</p>
                                        <p class="text-xs text-gray-400">Camping</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-500">Rp 30.000/jam</td>
                            <td class="px-4 py-3 text-center text-gray-500">1 Unit</td>
                            <td class="px-4 py-3 text-center font-medium text-gray-800">Rp 300.000</td>
                            <td class="px-4 py-3 text-center">
                                <span id="status-1" class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>Disewa
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Sleeping Bag</p>
                                        <p class="text-xs text-gray-400">Camping</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-500">Rp 15.000/jam</td>
                            <td class="px-4 py-3 text-center text-gray-500">1 Unit</td>
                            <td class="px-4 py-3 text-center font-medium text-gray-800">Rp 150.000</td>
                            <td class="px-4 py-3 text-center">
                                <span id="status-2" class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>Disewa
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Notif: Barang Diambil --}}
                <div id="notif-ambil" class="px-4 pb-4 pt-2">
                    <div class="flex items-center justify-between gap-3 bg-amber-50 border border-amber-200 rounded-lg px-4 py-3">
                        <p class="text-xs text-amber-800 flex-1">
                            Klik saat semua barang diserahkan ke pelanggan. Jam sewa &amp; batas kembali tercatat otomatis.
                        </p>
                        <button onclick="barangDiambil()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg transition whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Barang Diambil
                        </button>
                    </div>
                </div>

                {{-- Notif: Barang Dikembalikan --}}
                <div id="notif-kembali" class="hidden px-4 pb-4 pt-2">
                    <div class="flex items-center justify-between gap-3 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                        <p class="text-xs text-green-800 flex-1">
                            Konfirmasi pengembalian. Batas kembali: <strong id="batas-kembali">—</strong>. Klik saat barang diserahkan kembali.
                        </p>
                        <button onclick="barangDikembalikan()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Barang Dikembalikan
                        </button>
                    </div>
                </div>

                {{-- Notif: Selesai (disabled) --}}
                <div id="notif-selesai" class="hidden px-4 pb-4 pt-2">
                    <div class="flex items-center justify-between gap-3 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-500 flex-1">
                            Semua barang telah dikembalikan. Transaksi dapat diselesaikan.
                        </p>
                        <button disabled
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-200 text-gray-400 text-xs font-semibold rounded-lg cursor-not-allowed whitespace-nowrap">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kondisi Barang (muncul setelah dikembalikan) --}}
        <div id="kondisi-section" class="hidden">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Kondisi Barang Saat Pengembalian</p>
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/5">Nama Barang</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/3">Catatan Kondisi Awal</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/3">Catatan Kondisi Akhir</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Denda Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-800">Canon EOS R50</p>
                                <p class="text-xs text-gray-400">Kamera</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-xs text-gray-500">Kondisi sempurna tanpa ada kerusakan</p>
                            </td>
                            <td class="px-4 py-3">
                                <textarea oninput="hitungTotal()" placeholder="Catatan kondisi akhir..."
                                    class="w-full text-xs border border-gray-200 rounded-lg p-2 resize-none focus:outline-none focus:ring-1 focus:ring-emerald-400 min-h-[52px] text-gray-700"></textarea>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-center">
                                    <span class="text-xs text-gray-500">Rp</span>
                                    <input type="number" min="0" placeholder="0" oninput="hitungTotal()"
                                        class="w-28 text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-emerald-400 text-gray-700">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-800">Tenda Dome 4P</p>
                                <p class="text-xs text-gray-400">Camping</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-xs text-gray-500">Kondisi sempurna tanpa ada kerusakan</p>
                            </td>
                            <td class="px-4 py-3">
                                <textarea oninput="hitungTotal()" placeholder="Catatan kondisi akhir..."
                                    class="w-full text-xs border border-gray-200 rounded-lg p-2 resize-none focus:outline-none focus:ring-1 focus:ring-emerald-400 min-h-[52px] text-gray-700"></textarea>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-center">
                                    <span class="text-xs text-gray-500">Rp</span>
                                    <input type="number" min="0" placeholder="0" oninput="hitungTotal()"
                                        class="w-28 text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-emerald-400 text-gray-700">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-800">Sleeping Bag</p>
                                <p class="text-xs text-gray-400">Camping</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-xs text-gray-500">Kondisi sempurna tanpa ada kerusakan</p>
                            </td>
                            <td class="px-4 py-3">
                                <textarea oninput="hitungTotal()" placeholder="Catatan kondisi akhir..."
                                    class="w-full text-xs border border-gray-200 rounded-lg p-2 resize-none focus:outline-none focus:ring-1 focus:ring-emerald-400 min-h-[52px] text-gray-700"></textarea>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-center">
                                    <span class="text-xs text-gray-500">Rp</span>
                                    <input type="number" min="0" placeholder="0" oninput="hitungTotal()"
                                        class="w-28 text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-emerald-400 text-gray-700">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Ringkasan Biaya --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ringkasan Biaya</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-3">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Subtotal Sewa</span>
                    <span class="font-medium text-gray-800">Rp 700.000</span>
                </div>
                <div class="flex justify-between text-sm text-gray-600 pb-3 border-b border-dashed border-gray-200">
                    <span>Denda Keterlambatan</span>
                    <span class="text-gray-400">Rp —</span>
                </div>
                <div class="flex justify-between text-sm text-gray-600 pb-3 border-b border-dashed border-gray-200">
                    <span>Denda Kerusakan</span>
                    <span id="denda-kerusakan-total" class="text-gray-400">Rp —</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-800 pt-1">
                    <span>Total Harga</span>
                    <span id="grand-total" class="text-emerald-700 text-base">Rp 700.000</span>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-end gap-3 pt-1 pb-6">
            <a href="{{ route('Transaksi') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
            <button id="btn-selesai" disabled onclick="selesaiTransaksi()"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-emerald-600">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Transaksi Selesai
            </button>
        </div>

    </div>

    <script>
        const SUBTOTAL = 700000;

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function setAllStatus(bgClass, textClass, dotClass, label) {
            for (let i = 0; i < 3; i++) {
                const el = document.getElementById('status-' + i);
                el.className = `inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full ${bgClass} ${textClass}`;
                el.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${dotClass} inline-block"></span>${label}`;
            }
        }

        function barangDiambil() {
            // Update semua status badge → Diambil (amber)
            setAllStatus('bg-amber-50', 'text-amber-700', 'bg-amber-500', 'Diambil');

            // Hitung batas kembali (sekarang + 4 hari sebagai contoh)
            const now = new Date();
            now.setDate(now.getDate() + 4);
            const tgl = now.toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' });
            const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('batas-kembali').textContent = tgl + ' ' + jam;

            // Toggle notif bar
            document.getElementById('notif-ambil').classList.add('hidden');
            document.getElementById('notif-kembali').classList.remove('hidden');
        }

        function barangDikembalikan() {
            // Update semua status badge → Dikembalikan (green)
            setAllStatus('bg-emerald-50', 'text-emerald-700', 'bg-emerald-500', 'Dikembalikan');

            // Toggle notif bar
            document.getElementById('notif-kembali').classList.add('hidden');
            document.getElementById('notif-selesai').classList.remove('hidden');

            // Tampilkan card kondisi barang
            document.getElementById('kondisi-section').classList.remove('hidden');

            // Aktifkan tombol Transaksi Selesai
            const btnSelesai = document.getElementById('btn-selesai');
            btnSelesai.disabled = false;
        }

        function hitungTotal() {
            const inputs = document.querySelectorAll('#kondisi-section input[type=number]');
            let totalDenda = 0;
            inputs.forEach(inp => {
                const val = parseInt(inp.value) || 0;
                totalDenda += val;
            });

            const dendaEl = document.getElementById('denda-kerusakan-total');
            const grandEl = document.getElementById('grand-total');

            if (totalDenda > 0) {
                dendaEl.textContent = formatRupiah(totalDenda);
                dendaEl.classList.remove('text-gray-400');
                dendaEl.classList.add('text-gray-800');
            } else {
                dendaEl.textContent = 'Rp —';
                dendaEl.classList.remove('text-gray-800');
                dendaEl.classList.add('text-gray-400');
            }

            grandEl.textContent = formatRupiah(SUBTOTAL + totalDenda);
        }

        function selesaiTransaksi() {
            if (confirm('Tandai transaksi TRX001 sebagai selesai?')) {
                alert('Transaksi TRX001 berhasil diselesaikan!');
            }
        }
    </script>

</body>
</html>
</x-app-layout>