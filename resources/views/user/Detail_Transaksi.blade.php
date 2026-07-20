<x-app3-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi') }}
        </h2>
    </x-slot>

    @php
        $status = trim($rental->status_rental ?? '');
        $statusLabel = 'Status Tidak Diketahui';
        $badgeClasses = 'bg-gray-100 text-gray-600';

        if ($status === 'Diajukan') {
            $statusLabel = 'Pengajuan';
            $badgeClasses = 'bg-amber-50 text-amber-700 border border-amber-200';
        } elseif ($status === 'Disewa') {
            $statusLabel = 'Sedang Disewa';
            $badgeClasses = 'bg-blue-50 text-blue-700 border border-blue-200';
        } elseif ($status === 'Dikembalikan') {
            $statusLabel = 'Dikembalikan';
            $badgeClasses = 'bg-emerald-50 text-emerald-800 border border-emerald-200';
        } elseif ($status === 'Selesai') {
            $statusLabel = 'Selesai';
            $badgeClasses = 'bg-gray-100 text-gray-700 border border-gray-200';
        } elseif ($status === 'Dibatalkan') {
            $statusLabel = 'Dibatalkan';
            $badgeClasses = 'bg-red-50 text-red-700 border border-red-200';
        }

        $showCondition = in_array($status, ['Disewa', 'Dikembalikan', 'Selesai']);

        $duration = null;
        $durationLabel = '-';
        if ($rental->waktu_sewa && $rental->waktu_kembali) {
            $durationDays  = (int) $rental->waktu_sewa->diffInDays($rental->waktu_kembali);
            $durationHours = (int) $rental->waktu_sewa->diffInHours($rental->waktu_kembali);
            $isDailyRental = $rental->waktu_sewa->format('H:i:s') === '00:00:00'
                && $rental->waktu_kembali->format('H:i:s') === '23:59:59';
            if ($isDailyRental) {
                $duration      = max($durationDays, 1);
                $durationLabel = $duration . ' Hari';
            } else {
                $duration      = max($durationHours, 1);
                $durationLabel = $duration . ' Jam';
            }
        }

        // Tombol Batalkan: aktif hanya saat status Diajukan
        $canCancel  = $status === 'Diajukan';
    @endphp

    {{-- ─── Floating Back Button ─── --}}
    <a href="{{ route('users.history') }}"
        class="fixed top-[82px] left-4 z-30 inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl shadow-md hover:bg-gray-50 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 group">
        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali
    </a>

    <div class="mx-4 md:mx-10 py-6 space-y-5">

        {{-- ─── Header ─── --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Detail Transaksi</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap transaksi sewa barang</p>
                <span class="inline-flex items-center gap-2 mt-3 px-3 py-1 rounded-full text-xs font-medium {{ $badgeClasses }}">
                    <span class="w-1.5 h-1.5 rounded-full
                        {{ $status === 'Diajukan' ? 'bg-amber-400' : '' }}
                        {{ $status === 'Disewa' ? 'bg-blue-400' : '' }}
                        {{ $status === 'Dikembalikan' ? 'bg-emerald-500' : '' }}
                        {{ $status === 'Selesai' ? 'bg-gray-400' : '' }}
                        {{ $status === 'Dibatalkan' ? 'bg-red-400' : '' }}
                        inline-block"></span>
                    {{ $statusLabel }}
                </span>
            </div>
            <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-mono font-bold text-emerald-800">
                {{ $rental->kode_rental }}
            </span>
        </div>

        {{-- ─── Detail Penyewa ─── --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Detail Penyewa</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
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
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Sewa</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->waktu_sewa)->format('d M Y, H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Tanggal Kembali</p>
                        <p class="text-sm font-medium text-gray-800">{{ optional($rental->waktu_kembali)->format('d M Y, H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Durasi</p>
                        <p class="text-sm font-medium text-gray-800">{{ $durationLabel }}</p>
                    </div>
                </div>

                @if(in_array($rental->metode_pembayaran, ['QRIS', 'Transfer Bank']) && $rental->bukti_pembayaran)
                    <div class="mt-5 pt-4 border-t border-dashed border-gray-200">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Bukti Pembayaran</p>
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="grow">
                                <p class="text-sm font-medium text-gray-800">Metode: {{ $rental->metode_pembayaran }}</p>
                                <p class="text-xs text-gray-500">Foto bukti pembayaran tampak di bawah.</p>
                            </div>
                            <a href="{{ asset('storage/' . ltrim($rental->bukti_pembayaran, '/')) }}" target="_blank"
                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg hover:bg-emerald-100 transition">
                                Lihat Bukti Pembayaran
                            </a>
                        </div>
                        <div class="mt-4 overflow-hidden rounded-xl border border-gray-200 bg-gray-50" style="width: 320px; height: 320px;">
                            <img src="{{ asset('storage/' . ltrim($rental->bukti_pembayaran, '/')) }}"
                                alt="Bukti Pembayaran {{ $rental->metode_pembayaran }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- ─── Detail Produk ─── --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Detail Produk</p>
            <div class="bg-white border border-gray-200 rounded-xl overflow-x-auto">
                <table class="w-full text-sm text-left min-w-[700px]">
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
                                $harga  = $barang->harga_perjam ?: $barang->harga_perhari ?: 0;
                                if ($status === 'Diajukan') {
                                    $itemStatus     = 'Menunggu';
                                    $itemLabelClass = 'bg-amber-50 text-amber-700';
                                    $itemDot        = 'bg-amber-400';
                                } elseif ($status === 'Disewa') {
                                    $itemStatus     = 'Disewa';
                                    $itemLabelClass = 'bg-blue-50 text-blue-700';
                                    $itemDot        = 'bg-blue-400';
                                } elseif ($status === 'Dikembalikan') {
                                    $itemStatus     = 'Dikembalikan';
                                    $itemLabelClass = 'bg-emerald-50 text-emerald-700';
                                    $itemDot        = 'bg-emerald-500';
                                } elseif ($status === 'Selesai') {
                                    $itemStatus     = 'Selesai';
                                    $itemLabelClass = 'bg-gray-100 text-gray-600';
                                    $itemDot        = 'bg-gray-400';
                                } elseif ($status === 'Dibatalkan') {
                                    $itemStatus     = 'Dibatalkan';
                                    $itemLabelClass = 'bg-red-50 text-red-600';
                                    $itemDot        = 'bg-red-400';
                                } else {
                                    $itemStatus     = '-';
                                    $itemLabelClass = 'bg-gray-50 text-gray-500';
                                    $itemDot        = 'bg-gray-300';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-16 h-16 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            <img src="{{ $barang->fotoUtamaUrl() ?? asset('images/default.png') }}"
                                                alt="{{ $barang->nama_barang ?? 'Barang' }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $barang->nama_barang ?? '-' }}</p>
                                            <p class="text-xs text-gray-400">{{ $barang->kategori_barang ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center text-gray-600 text-xs">
                                    Rp {{ number_format($harga, 0, ',', '.') }}{{ $barang->harga_perjam ? '/jam' : '/hari' }}
                                </td>
                                <td class="px-4 py-3 text-center text-gray-600 text-sm">
                                    {{ $detail->jumlah_barang }} Unit
                                </td>
                                <td class="px-4 py-3 text-center font-medium text-gray-800">
                                    Rp {{ number_format($detail->subtotal ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full {{ $itemLabelClass }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $itemDot }} inline-block"></span>
                                        {{ $itemStatus }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ─── Kondisi Barang (hanya tampil setelah Disewa) ─── --}}
        @if($showCondition)
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Kondisi Barang</p>
                <div class="bg-white border border-gray-200 rounded-xl overflow-x-auto">
                    <table class="w-full text-sm text-left min-w-[700px]">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/4">Nama Barang</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/3">Catatan Kondisi Awal</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 w-1/3">Catatan Kondisi Akhir</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Denda Kerusakan</th>
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 text-center">Denda Keterlambatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($rental->detailRentals as $detail)
                                @php
                                    $calculatedLate = $detail->calculated_denda_keterlambatan ?? ($detail->denda_keterlambatan ?? 0);
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <p class="text-sm font-medium text-gray-800">{{ optional($detail->barang)->nama_barang ?? '-' }}</p>
                                        <p class="text-xs text-gray-400">{{ optional($detail->barang)->kategori_barang ?? '-' }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-xs text-gray-500">{{ $detail->catatan_kondisi ?: 'Tidak ada catatan awal.' }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-xs text-gray-500">{{ $detail->catatan_kondisi ?: 'Belum ada catatan akhir.' }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-xs font-medium text-gray-800">
                                            Rp {{ number_format($detail->denda_kerusakan ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-xs font-medium text-gray-800">
                                            Rp {{ number_format($calculatedLate, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- ─── Ringkasan Biaya ─── --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ringkasan Biaya</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-3">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Biaya Checkout Terbayar</span>
                    <span class="font-medium text-gray-800">Rp {{ number_format($checkoutPaid, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-gray-400">Biaya yang sudah dibayarkan saat checkout.</p>
            </div>
        </div>

        {{-- ─── Ringkasan Denda (sembunyikan saat Diajukan) ─── --}}
        @if($status !== 'Diajukan')
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ringkasan Denda</p>
                <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-3">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Denda Keterlambatan</span>
                        <span class="{{ $dendaKeterlambatan > 0 ? 'font-medium text-gray-800' : 'text-gray-400' }}">
                            {{ $dendaKeterlambatan > 0 ? 'Rp ' . number_format($dendaKeterlambatan, 0, ',', '.') : 'Rp —' }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Denda Kerusakan</span>
                        <span class="{{ $dendaKerusakan > 0 ? 'font-medium text-gray-800' : 'text-gray-400' }}">
                            {{ $dendaKerusakan > 0 ? 'Rp ' . number_format($dendaKerusakan, 0, ',', '.') : 'Rp —' }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm font-semibold text-gray-800 pt-3 border-t border-dashed border-gray-200">
                        <span>Total Denda</span>
                        <span class="text-emerald-700 text-base">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- ─── Action Bar ─── --}}
        <div class="flex items-center justify-end pt-1">

            {{-- Tombol Batalkan --}}
            @if($canCancel)
                {{-- Aktif: status Diajukan --}}
                <button type="button" onclick="showCancelConfirmation()"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-lg hover:bg-red-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batalkan Pesanan
                </button>
            @elseif(!in_array($status, ['Selesai', 'Dibatalkan']))
                {{-- Disable: sudah Disewa ke atas --}}
                <button type="button" disabled title="Pesanan yang sedang disewa tidak dapat dibatalkan"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-red-300 border border-red-300 rounded-lg cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batalkan Pesanan
                </button>
            @endif
        </div>

    </div>

    {{-- ─── Modal Konfirmasi Pembatalan ─── --}}
    @if($canCancel)
        <div id="cancelConfirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4v2m0-12a9 9 0 110 18 9 9 0 010-18z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Batalkan Pesanan</h3>
                        <p class="text-sm text-gray-500">Tindakan ini tidak dapat diurungkan</p>
                    </div>
                </div>

                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-sm text-red-800">
                        <strong>Perhatian:</strong> Setelah dibatalkan, pesanan Anda tidak dapat diaktifkan kembali. Proses refund akan dilakukan paling lambat <strong>3×24 jam</strong>.
                    </p>
                </div>

                <form method="POST" action="{{ route('users.history.cancel', $rental->kode_rental) }}">
                    @csrf
                    <div class="flex gap-2 justify-end pt-2">
                        <button type="button" onclick="hideCancelConfirmation()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 transition">
                            Kembali
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-lg hover:bg-red-700 transition">
                            Ya, Batalkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        function showCancelConfirmation() {
            document.getElementById('cancelConfirmationModal').classList.remove('hidden');
        }
        function hideCancelConfirmation() {
            document.getElementById('cancelConfirmationModal').classList.add('hidden');
        }
        @if($canCancel)
        document.getElementById('cancelConfirmationModal').addEventListener('click', function(e) {
            if (e.target === this) hideCancelConfirmation();
        });
        @endif
    </script>

</x-app3-layout>
