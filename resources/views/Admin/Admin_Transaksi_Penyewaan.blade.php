<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Daftar Transaksi Penyewaan</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh data transaksi sewa barang</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        {{-- Search & Filter --}}
        <form action="{{ route('Transaksi') }}" method="GET" class="mb-4 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
            <div class="flex flex-wrap gap-2 items-end">

                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-gray-500">Status</label>
                    <select name="status" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" autocomplete="off">
                        <option value="">Semua Status</option>
                        <option value="Diajukan" {{ request('status') === 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="Disewa" {{ request('status') === 'Disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="Dikembalikan" {{ request('status') === 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="Selesai" {{ request('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Dibatalkan" {{ request('status') === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="flex flex-col gap-1 flex-1 min-w-[220px]">
                    <label class="text-xs font-semibold text-gray-500">Cari transaksi</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode transaksi atau nama pelanggan..."
                        class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" autocomplete="off">
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-transparent select-none">_</label>
                    <button type="submit" class="rounded-lg bg-emerald-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-900">Filter</button>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-transparent select-none">_</label>
                    <a href="{{ route('Transaksi') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">Reset</a>
                </div>

            </div>
        </form>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200 text-center">
                    <tr>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-10">No</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Kode Transaksi</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-36">Nama Pelanggan</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Tanggal Sewa</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Tanggal Kembali</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Total Harga</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Status</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @if(isset($rentals) && $rentals->count())
                        @foreach($rentals as $rental)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-3 text-gray-400 text-xs">{{ ($rentals->currentPage()-1) * $rentals->perPage() + $loop->iteration }}</td>
                                <td class="px-3 py-3 text-gray-700">{{ $rental->kode_rental }}</td>
                                <td class="px-3 py-3 text-gray-600">{{ optional($rental->user)->name ?? '-' }}</td>
                                <td class="px-3 py-3 text-gray-600 text-xs">{{ optional($rental->waktu_sewa) ? \Carbon\Carbon::parse($rental->waktu_sewa)->format('Y-m-d') : '-' }}</td>
                                <td class="px-3 py-3 text-gray-600 text-xs">{{ optional($rental->waktu_kembali) ? \Carbon\Carbon::parse($rental->waktu_kembali)->format('Y-m-d') : '-' }}</td>
                                <td class="px-3 py-3 text-gray-600">Rp {{ number_format(optional($rental)->total_harga ?? 0,0,',','.') }}</td>
                                <td class="px-3 py-3">
                                    @php $status = trim(optional($rental)->status_rental ?? '-'); @endphp

                                    <span @class([
                                        'inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full',
                                        'bg-orange-100 text-orange-700' => $status === 'Diajukan',
                                        'bg-blue-100 text-blue-700' => $status === 'Disewa',
                                        'bg-emerald-100 text-emerald-700' => $status === 'Dikembalikan',
                                        'bg-gray-100 text-gray-700 border border-gray-200 shadow-sm' => $status === 'Selesai',
                                        'bg-red-100 text-red-700' => $status === 'Dibatalkan',
                                        'bg-gray-100 text-gray-700' => !in_array($status, ['Diajukan', 'Disewa', 'Dikembalikan', 'Selesai', 'Dibatalkan']),
                                    ])>
                                        <span @class([
                                            'w-1.5 h-1.5 rounded-full inline-block',
                                            'bg-orange-500' => $status === 'Diajukan',
                                            'bg-blue-500' => $status === 'Disewa',
                                            'bg-emerald-500' => $status === 'Dikembalikan',
                                            'bg-black' => $status === 'Selesai',
                                            'bg-red-500' => $status === 'Dibatalkan',
                                            'bg-gray-500' => !in_array($status, ['Diajukan', 'Disewa', 'Dikembalikan', 'Selesai', 'Dibatalkan']),
                                        ])></span>

                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <a href="{{ route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="py-6 text-sm text-gray-500">Tidak ada transaksi.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>

            <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                <p class="text-xs text-gray-500">Menampilkan {{ isset($rentals) ? $rentals->count() : 0 }} dari {{ isset($rentals) ? $rentals->total() : 0 }} transaksi</p>
                <p class="text-xs text-gray-500">Halaman {{ isset($rentals) ? $rentals->currentPage() : 1 }} dari {{ isset($rentals) ? $rentals->lastPage() : 1 }}</p>
            </div>
            <div class="px-4 py-3">
                @if(isset($rentals))
                    {{ $rentals->links() }}
                @endif
            </div>
        </div>

    </div>
</x-app-layout>