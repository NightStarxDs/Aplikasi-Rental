<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Riwayat Pelanggan</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Detail identitas dan riwayat transaksi pelanggan
                </p>
            </div>
        </div>
    </x-slot>

    {{-- ─── Floating Back Button ─── --}}
    <a href="{{ route('penjualan.index') }}"
        class="fixed top-[82px] left-4 z-30 inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl shadow-md hover:bg-gray-50 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 group">
        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali
    </a>

    <div class="py-6 px-6 space-y-5">

        @if (session('success'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 text-sm flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl bg-red-50 border border-red-200 text-red-800 p-4 text-sm flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Identitas Pelanggan --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                Identitas Pelanggan
            </p>

            <div class="bg-white border border-gray-200 rounded-xl p-5">

                <div class="flex items-center gap-4 mb-4">

                    <div class="w-14 h-14 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg font-semibold text-emerald-700">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-base font-semibold text-gray-800">
                            {{ $user->name }}
                        </p>

                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                            {{ ucfirst($user->role ?? 'User') }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-dashed border-gray-200">

                    <div>
                        <p class="text-xs text-gray-400 mb-1">ID Pengguna</p>
                        <p class="text-sm font-medium text-gray-800">
                            USR{{ str_pad($user->id_user, 3, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 mb-1">No Telepon</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $user->telepon ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 mb-1">Email</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 mb-1">Alamat</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $user->alamat ?? '-' }}
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">

                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Transaksi</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $totalTransaksi }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Pengeluaran</p>
                        <p class="text-lg font-semibold text-emerald-700">
                            Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Denda</p>
                        <p class="text-lg font-semibold text-red-600">
                            Rp {{ number_format($totalDenda, 0, ',', '.') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        {{-- Riwayat Transaksi --}}
        <div>

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                Riwayat Transaksi
            </p>

            <div class="bg-white border border-gray-200 rounded-xl overflow-x-auto">

                <table class="w-full text-sm text-left min-w-[900px]">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">ID Transaksi</th>
                            <th class="px-4 py-3">Tanggal Sewa</th>
                            <th class="px-4 py-3">Tanggal Kembali</th>
                            <th class="px-4 py-3">Barang</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Denda</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($rentals as $index => $rental)

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    {{ $rentals->firstItem() + $index }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $rental->kode_rental }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($rental->waktu_sewa)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($rental->waktu_kembali)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">

                                        @foreach ($rental->detailRentals as $detail)

                                            @php
                                                // Warna badge berdasarkan kategori barang
                                                $kategori = strtolower($detail->barang->kategori ?? '');

                                                $badgeClass = match (true) {
                                                    str_contains($kategori, 'kamera') =>
                                                        'bg-purple-50 text-purple-700',

                                                    str_contains($kategori, 'tenda'),
                                                    str_contains($kategori, 'camping') =>
                                                        'bg-emerald-50 text-emerald-700',

                                                    default =>
                                                        'bg-gray-100 text-gray-700',
                                                };
                                            @endphp

                                            <span class="text-xs px-2 py-1 rounded-full {{ $badgeClass }}">
                                                {{ $detail->barang->nama_barang ?? '-' }}
                                            </span>

                                        @endforeach

                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">
                                    Rp {{ number_format($rental->total_denda, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">

                                    @php
                                        $statusColor = match ($rental->status_rental) {
                                            'Diajukan' => 'bg-orange-100 text-orange-700',
                                            'Disewa' => 'bg-blue-100 text-blue-700',
                                            'Dikembalikan' => 'bg-emerald-100 text-emerald-700',
                                            'Selesai' => 'bg-emerald-100 text-emerald-700',
                                            'Dibatalkan' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColor }}">
                                        {{ $rental->status_rental }}
                                    </span>

                                </td>
                            
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <button onclick="showKodeRental('{{ $rental->kode_rental }}', '{{ $user->name }}', 'Rp {{ number_format($rental->total_harga, 0, ',', '.') }}', '{{ \Carbon\Carbon::parse($rental->waktu_sewa)->format('d M Y, H:i') }}', '{{ \Carbon\Carbon::parse($rental->waktu_kembali)->format('d M Y, H:i') }}')" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg transition shrink-0">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
                                            Kode Rental
                                        </button>
                                        <a href="{{ route('users.history.detail', ['kode_rental' => $rental->kode_rental]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition shrink-0">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            Detail
                                        </a>
                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="px-4 py-6 text-center text-gray-400">
                                    Belum ada riwayat transaksi.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

                @if ($rentals->hasPages())
                    <div class="p-4">
                        {{ $rentals->links() }}
                    </div>
                @endif

    </div>

    {{-- Form Pembatalan (Hidden) --}}
    <form id="cancel-rental-form" action="" method="POST" class="hidden">
        @csrf
    </form>

    {{-- Modal Konfirmasi Pembatalan --}}
    <div id="cancel-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden animate-fade-in" onclick="closeCancelModal(event)">
        <div class="bg-white rounded-2xl border border-gray-250 shadow-2xl max-w-sm w-full mx-4 overflow-hidden transform transition-all scale-100" onclick="event.stopPropagation()">
            <div class="p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1 leading-snug">Apakah anda yakin ingin membatalkan transaksi ini?</h3>
                <p class="text-xs text-gray-500 mb-6 leading-relaxed">Proses pengembalian dana akan dilakukan paling lama 3x24 Jam.</p>
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeCancelModal()" class="flex-1 px-4 py-2 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                        Kembali
                    </button>
                    <button type="button" onclick="submitCancellation()" class="flex-1 px-4 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition shadow-sm">
                        Batalkan Sewa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/f19fb034db.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        let activeCancelCode = null;

        function confirmCancel(code) {
            activeCancelCode = code;
            const modal = document.getElementById('cancel-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCancelModal(event) {
            const modal = document.getElementById('cancel-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            activeCancelCode = null;
        }

        function submitCancellation() {
            if (!activeCancelCode) return;
            const form = document.getElementById('cancel-rental-form');
            form.action = `/riwayat/${activeCancelCode}/cancel`;
            form.submit();
        }

        // --- Kode Rental Modal Logic ---
        function showKodeRental(kode, penyewa, total, ambil, kembali) {
            document.getElementById('modal-kode').innerText = kode;
            document.getElementById('modal-penyewa').innerText = penyewa;
            document.getElementById('modal-total').innerText = total;
            document.getElementById('modal-ambil').innerText = ambil;
            document.getElementById('modal-kembali').innerText = kembali;

            document.getElementById('canvas-kode').innerText = kode;
            document.getElementById('canvas-penyewa').innerText = penyewa;
            document.getElementById('canvas-total').innerText = total;
            document.getElementById('canvas-ambil').innerText = ambil;
            document.getElementById('canvas-kembali').innerText = kembali;

            const modal = document.getElementById('kode-rental-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeKodeRentalModal(event) {
            const modal = document.getElementById('kode-rental-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.getElementById('download-kode-btn')?.addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            const kode = document.getElementById('modal-kode').innerText;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            const proofElement = document.getElementById('hidden-kode-proof');

            setTimeout(() => {
                html2canvas(proofElement, {
                    scale: 3,
                    backgroundColor: '#ffffff',
                    useCORS: true,
                    logging: false,
                    width: 600,
                    height: proofElement.offsetHeight
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Bukti_Rental_' + kode + '.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();

                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Berhasil Diunduh';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, 2000);
                }).catch(err => {
                    console.error("Error generating image", err);
                    alert("Gagal mengunduh gambar.");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }, 100);
        });
    </script>

    <!-- Global Modal for Kode Rental -->
    <div id="kode-rental-modal" class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/60 backdrop-blur-sm p-4 hidden animate-fade-in" onclick="closeKodeRentalModal(event)">
        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl p-6 md:p-8 transform transition-all" onclick="event.stopPropagation()">
            
            <button onclick="closeKodeRentalModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 mb-3 shadow-sm">
                    <i class="fa-solid fa-qrcode text-2xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Kode Rental Anda</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan kode ini sebagai bukti pesanan Anda.</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 mb-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-2xl opacity-60 pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col items-center justify-center mb-4 pb-4 border-b border-gray-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kode Rental</p>
                        <div id="modal-kode" class="text-3xl font-extrabold text-emerald-600 font-mono tracking-widest bg-emerald-100/50 px-4 py-1.5 rounded-lg border border-emerald-200 shadow-sm">
                            -
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-center sm:text-left">
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Penyewa</p>
                            <p id="modal-penyewa" class="font-medium text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Total Harga</p>
                            <p id="modal-total" class="font-bold text-emerald-600">-</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Ambil</p>
                            <p id="modal-ambil" class="font-medium text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Kembali</p>
                            <p id="modal-kembali" class="font-medium text-gray-800">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <button id="download-kode-btn" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 text-white hover:bg-emerald-700 rounded-xl font-bold transition shadow-sm text-sm">
                    <i class="fa-solid fa-download"></i>
                    Unduh Gambar
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden element strictly for html2canvas -->
    <div style="position: absolute; left: -9999px; top: 0;">
        <div id="hidden-kode-proof" style="width: 600px; padding: 40px; background-color: #ffffff; color: #1f2937; font-family: 'Inter', sans-serif; box-sizing: border-box;">
            <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 20px;">
                <h1 style="margin: 0; font-size: 24px; color: #059669; font-weight: 800;">Bukti Penyewaan Barang</h1>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #6b7280;">Aplikasi Penyewaan Alat Camping & Kamera</p>
            </div>

            <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Kode Rental</p>
                    <p id="canvas-kode" style="margin: 5px 0 0 0; font-size: 28px; font-weight: 900; color: #059669; font-family: monospace; letter-spacing: 2px;">-</p>
                </div>
            </div>

            <div style="margin-bottom: 30px; display: flex; flex-wrap: wrap; background-color: #f9fafb; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px;">
                <div style="width: 50%; margin-bottom: 20px;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Nama Penyewa</p>
                    <p id="canvas-penyewa" style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">-</p>
                </div>
                <div style="width: 50%; margin-bottom: 20px;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Total Harga</p>
                    <p id="canvas-total" style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold; color: #059669;">-</p>
                </div>
                <div style="width: 50%;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Waktu Ambil</p>
                    <p id="canvas-ambil" style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">-</p>
                </div>
                <div style="width: 50%;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Waktu Kembali</p>
                    <p id="canvas-kembali" style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">-</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 35px; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; padding-top: 15px; font-weight: 500;">
                <strong style="color: #059669;">NightStarxDs</strong> &copy; Di-generate pada {{ now()->format('d M Y, H:i') }}
            </div>
        </div>
    </div>
</x-app3-layout>