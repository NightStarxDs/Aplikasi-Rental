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

    <div class="py-6 px-6 space-y-5">

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

                <div class="grid grid-cols-4 gap-4 pt-4 border-t border-dashed border-gray-200">

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

                <div class="grid grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">

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

            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <table class="w-full text-sm text-left">
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
                                            'Dibatalkan' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColor }}">
                                        {{ $rental->status_rental }}
                                    </span>

                                </td>

                                <td class="px-4 py-3">
                                    <a href="{{ route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Detail
                                    </a>
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
        </div>

    </div>
</x-app3-layout>