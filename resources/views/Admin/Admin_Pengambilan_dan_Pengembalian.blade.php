<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengambilan & Pengembalian') }}
        </h2>
    </x-slot>

    @php
        $status = trim($rental->status_rental ?? '');
        $statusLabel = 'Status Tidak Diketahui';
        $badgeClasses = 'bg-gray-50 text-gray-800';

        if ($status === 'Diajukan') {
            $statusLabel = 'Belum Diambil';
            $badgeClasses = 'bg-amber-50 text-amber-700';
        } elseif ($status === 'Disewa') {
            $statusLabel = 'Disewa';
            $badgeClasses = 'bg-blue-50 text-blue-700';
        } elseif ($status === 'Dikembalikan') {
            $statusLabel = 'Dikembalikan';
            $badgeClasses = 'bg-emerald-50 text-emerald-800';
        } elseif ($status === 'Dibatalkan') {
            $statusLabel = 'Dibatalkan';
            $badgeClasses = 'bg-red-50 text-red-700';
        }

        $buttonAction = $status === 'Diajukan' ? 'ambil' : 'kembali';
        $buttonLabel = $status === 'Diajukan' ? 'Barang Diambil' : ($status === 'Disewa' ? 'Barang Dikembalikan' : 'Transaksi Selesai');
        $buttonDisabled = in_array($status, ['Dikembalikan', 'Dibatalkan']);
        $showCondition = $status !== 'Diajukan';
        $duration = null;
        $durationLabel = '-';

        if ($rental->waktu_sewa && $rental->waktu_kembali) {
            $durationDays = (int) $rental->waktu_sewa->diffInDays($rental->waktu_kembali);
            $durationHours = (int) $rental->waktu_sewa->diffInHours($rental->waktu_kembali);

            $isDailyRental = $rental->waktu_sewa->format('H:i:s') === '00:00:00'
                && $rental->waktu_kembali->format('H:i:s') === '23:59:59';

            if ($isDailyRental) {
                $duration = max($durationDays, 1);
                $durationLabel = $duration . ' Hari';
            } else {
                $duration = max($durationHours, 1);
                $durationLabel = $duration . ' Jam';
            }
        }

        $returnDeadline = $rental->waktu_kembali ? $rental->waktu_kembali->format('Y-m-d H:i') : '-';
    @endphp

<body class="bg-gray-100 min-h-screen p-6">

    <div class="mx-10 space-y-5">

        @if(session('success'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Detail Transaksi</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap transaksi sewa barang</p>
                <span class="inline-flex items-center gap-2 mt-3 px-2.5 py-1 rounded-full text-xs font-medium {{ $badgeClasses }}">
                    {{ $statusLabel }}
                </span>
            </div>
            <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-mono font-bold text-emerald-800">
                {{ $rental->kode_rental }}
            </span>
        </div>

        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Detail Penyewa</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Nama Pelanggan</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->user)->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Nomor Telepon</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->user)->telepon ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Email</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->user)->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Sewa</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->waktu_sewa)->format('Y-m-d H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Kembali</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->waktu_kembali)->format('Y-m-d H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Durasi</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $durationLabel }}
                        </p>
                    </div>
                </div>

                @if(in_array($rental->metode_pembayaran, ['QRIS', 'Transfer Bank']) && $rental->bukti_pembayaran)
                    <div class="mt-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Bukti Pembayaran</p>
                        <div class="bg-white border border-gray-200 rounded-xl p-4">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                <div class="grow">
                                    <p class="text-sm font-medium text-gray-800">Metode Pembayaran: {{ $rental->metode_pembayaran }}</p>
                                    <p class="text-xs text-gray-500">Foto bukti pembayaran tampak di bawah.</p>
                                </div>
                                <a href="{{ asset('storage/' . ltrim($rental->bukti_pembayaran, '/')) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                                    Lihat Bukti Pembayaran
                                </a>
                            </div>
                            <div class="mt-4 overflow-hidden rounded-xl border border-gray-200 bg-gray-50" style="width: 360px; height: 360px;">
                                <img src="{{ asset('storage/' . ltrim($rental->bukti_pembayaran, '/')) }}" alt="Bukti Pembayaran {{ $rental->metode_pembayaran }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <form method="POST" action="{{ route('Pengambilan_dan_Pengembalian.update', ['kode_rental' => $rental->kode_rental]) }}">
            @csrf
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
                            @foreach($rental->detailRentals as $detail)
                                @php
                                    $barang = $detail->barang;
                                    $harga = $barang->harga_perjam ?: $barang->harga_perhari ?: 0;
                                    $itemStatus = $status === 'Diajukan' ? 'Belum Diambil' : ($status === 'Disewa' ? 'Disewa' : 'Dikembalikan');
                                    $itemLabelClass = $status === 'Diajukan' ? 'bg-amber-50 text-amber-700' : ($status === 'Disewa' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700');
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-20 h-20 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                                <img src="{{ $barang->fotoUtamaUrl() ?? asset('images/default.png') }}" alt="{{ $barang->nama_barang ?? 'Barang' }}" class="w-full h-full object-cover rounded-lg">
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">{{ $barang->nama_barang ?? '-' }}</p>
                                                <p class="text-xs text-gray-400">{{ $barang->kategori_barang ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-500">Rp {{ number_format($harga,0,',','.') }}{{ $barang->harga_perjam ? '/jam' : '/hari' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-500">{{ $detail->jumlah_barang }} Unit</td>
                                    <td class="px-4 py-3 text-center font-medium text-gray-800">Rp {{ number_format($detail->subtotal ?? 0,0,',','.') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full {{ $itemLabelClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $status === 'Diajukan' ? 'bg-amber-400' : ($status === 'Disewa' ? 'bg-blue-400' : 'bg-emerald-500') }} inline-block"></span>
                                            {{ $itemStatus }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-4 pb-4 pt-2">
                        @if($status === 'Diajukan')
                            <div class="flex items-center justify-between gap-3 bg-amber-50 border border-amber-200 rounded-lg px-4 py-3">
                                <p class="text-xs text-amber-800 flex-1">
                                    Klik saat semua barang diserahkan ke pelanggan. Jam sewa &amp; batas kembali tercatat otomatis.
                                </p>
                            </div>
                        @elseif($status === 'Disewa')
                            <div class="flex items-center justify-between gap-3 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                                <p class="text-xs text-green-800 flex-1">
                                    Konfirmasi pengembalian. Batas kembali: <strong>{{ $returnDeadline }}</strong>. Isi kondisi dan denda sebelum menutup transaksi.
                                </p>
                            </div>
                        @else
                            <div class="flex items-center justify-between gap-3 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                                <p class="text-xs text-gray-500 flex-1">
                                    Semua barang telah dikembalikan. Transaksi diselesaikan.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="kondisi-section" class="{{ $showCondition ? '' : 'hidden' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Kondisi Barang Saat Pengembalian</p>
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/6">Nama Barang</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/4">Catatan Kondisi Awal</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/4">Catatan Kondisi Akhir</th>
                                
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center w-1/6">Denda Kerusakan</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center w-1/6">Denda Keterlambatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($rental->detailRentals as $detail)
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="text-sm font-medium text-gray-800">{{ optional($detail->barang)->nama_barang ?? '-' }}</p>
                                        <p class="text-xs text-gray-400">{{ optional($detail->barang)->kategori_barang ?? '-' }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-xs text-gray-500">{{ $detail->catatan_kondisi ?: 'Tidak ada catatan awal.' }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($status === 'Dikembalikan')
                                            <p class="text-xs text-gray-500">{{ $detail->catatan_kondisi ?: 'Tidak ada catatan akhir.' }}</p>
                                        @else
                                            <textarea name="catatan_kondisi[{{ $detail->kode_detail }}]" placeholder="Catatan kondisi akhir..."
                                                class="w-full text-xs border border-gray-200 rounded-lg p-2 resize-none focus:outline-none focus:ring-1 focus:ring-emerald-400 min-h-[52px] text-gray-700">{{ old('catatan_kondisi.' . $detail->kode_detail, $detail->catatan_kondisi) }}</textarea>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($status === 'Dikembalikan')
                                            <span class="text-xs text-gray-800">Rp {{ number_format($detail->denda_kerusakan ?? 0,0,',','.') }}</span>
                                        @else
                                            <div class="flex items-center gap-1 justify-center">
                                                <span class="text-xs text-gray-500">Rp</span>
                                                <input name="denda_kerusakan[{{ $detail->kode_detail }}]" type="number" min="0" value="{{ old('denda_kerusakan.' . $detail->kode_detail, $detail->denda_kerusakan ?? 0) }}" oninput="hitungTotal()"
                                                    class="w-28 text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-emerald-400 text-gray-700">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($status === 'Dikembalikan')
                                            <span class="text-xs text-gray-800">Rp {{ number_format($detail->denda_keterlambatan ?? 0,0,',','.') }}</span>
                                        @else
                                            <div class="flex items-center gap-1 justify-center">
                                                <span class="text-xs text-gray-500">Rp</span>
                                                <input name="denda_keterlambatan[{{ $detail->kode_detail }}]" type="number" min="0" value="{{ old('denda_keterlambatan.' . $detail->kode_detail, $detail->denda_keterlambatan ?? 0) }}" oninput="hitungTotal()"
                                                    class="w-28 text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-emerald-400 text-gray-700">
                                            </div>
                                        @endif
                                    </td>
                                    <input type="hidden" name="detail_ids[]" value="{{ $detail->kode_detail }}">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Ringkasan Biaya</p>
                <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-3">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Biaya Checkout Terbayar</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($checkoutPaid,0,',','.') }}</span>
                    </div>
                    <div class="text-xs text-gray-500">Hanya menampilkan biaya yang sudah dibayarkan saat checkout.</div>
                </div>
            </div>

            <div class="{{ $status === 'Diajukan' ? 'hidden' : '' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Ringkasan Biaya Denda</p>
                <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-3">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Denda Keterlambatan</span>
                        <span id="denda-keterlambatan-display" class="{{ $dendaKeterlambatan > 0 ? 'text-gray-800' : 'text-gray-400' }}">{{ $dendaKeterlambatan > 0 ? 'Rp ' . number_format($dendaKeterlambatan,0,',','.') : 'Rp —' }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Denda Kerusakan</span>
                        <span id="denda-kerusakan-total" class="{{ $dendaKerusakan > 0 ? 'text-gray-800' : 'text-gray-400' }}">{{ $dendaKerusakan > 0 ? 'Rp ' . number_format($dendaKerusakan,0,',','.') : 'Rp —' }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-semibold text-gray-800 pt-3 border-t border-dashed border-gray-200">
                        <span>Total Denda</span>
                        <span id="denda-total" class="text-emerald-700 text-base">Rp {{ number_format($totalDenda,0,',','.') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-1 mt-4">
                <a href="{{ route('Transaksi') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Kembali
                </a>

                <div class="flex items-center gap-2">
                    <button type="submit" name="action" value="{{ $buttonAction }}" {{ $buttonDisabled ? 'disabled' : '' }}
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-emerald-600">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $buttonLabel }}
                    </button>
                </div>
            </div>
        </form>

    </div>

    <script>
        const CHECKOUT_PAID = {{ $checkoutPaid }};

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitungTotal() {
            const dendaKerusakanInputs = document.querySelectorAll('input[name^="denda_kerusakan"]');
            const dendaKeterlambatanInputs = document.querySelectorAll('input[name^="denda_keterlambatan"]');
            let totalKerusakan = 0;
            let totalKeterlambatan = 0;

            dendaKerusakanInputs.forEach(inp => {
                totalKerusakan += Number(inp.value) || 0;
            });
            dendaKeterlambatanInputs.forEach(inp => {
                totalKeterlambatan += Number(inp.value) || 0;
            });

            const dendaKerusakanDisplay = document.getElementById('denda-kerusakan-total');
            const dendaKeterlambatanDisplay = document.getElementById('denda-keterlambatan-display');
            const dendaTotal = document.getElementById('denda-total');

            const totalDenda = Math.round(totalKerusakan + totalKeterlambatan);

            dendaKerusakanDisplay.textContent = totalKerusakan > 0 ? formatRupiah(totalKerusakan) : 'Rp —';
            dendaKerusakanDisplay.classList.toggle('text-gray-800', totalKerusakan > 0);
            dendaKerusakanDisplay.classList.toggle('text-gray-400', totalKerusakan === 0);

            dendaKeterlambatanDisplay.textContent = totalKeterlambatan > 0 ? formatRupiah(totalKeterlambatan) : 'Rp —';
            dendaKeterlambatanDisplay.classList.toggle('text-gray-800', totalKeterlambatan > 0);
            dendaKeterlambatanDisplay.classList.toggle('text-gray-400', totalKeterlambatan === 0);

            if (dendaTotal) {
                dendaTotal.textContent = formatRupiah(totalDenda);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('input[name^="denda_kerusakan"]')) {
                hitungTotal();
            }
        });
    </script>

</body>
</x-app-layout>
