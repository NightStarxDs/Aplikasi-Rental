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
        <div class="flex items-center mb-4">
            <select class="px-3 py-2 text-sm text-white bg-emerald-800 hover:bg-emerald-900 rounded-l-lg outline-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="diproses">Diproses</option>
                <option value="disewa">Disewa</option>
                <option value="selesai">Selesai</option>
            </select>
            <input type="text" placeholder="Cari kode transaksi atau nama pelanggan..."
                class="flex-1 px-3 py-2 text-sm bg-white border border-gray-200 border-l-0 border-r-0 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-emerald-500">
            <button class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-r-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Cari
            </button>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm text-left" style="table-layout:fixed">
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
                    @if(isset($details) && $details->count())
                        @foreach($details as $detail)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-3 text-gray-400 text-xs">{{ ($details->currentPage()-1) * $details->perPage() + $loop->iteration }}</td>
                                <td class="px-3 py-3 text-gray-700">{{ $detail->kode_rental }}</td>
                                <td class="px-3 py-3 text-gray-600">{{ optional($detail->rental->user)->name ?? '-' }}</td>
                                <td class="px-3 py-3 text-gray-600 text-xs">{{ optional($detail->rental->waktu_sewa) ? \Carbon\Carbon::parse($detail->rental->waktu_sewa)->format('Y-m-d') : '-' }}</td>
                                <td class="px-3 py-3 text-gray-600 text-xs">{{ optional($detail->rental->waktu_kembali) ? \Carbon\Carbon::parse($detail->rental->waktu_kembali)->format('Y-m-d') : '-' }}</td>
                                <td class="px-3 py-3 text-gray-600">Rp {{ number_format(optional($detail->rental)->total_harga ?? 0,0,',','.') }}</td>
                                <td class="px-3 py-3">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-100 inline-block"></span>{{ trim(optional($detail->rental)->status_rental ?? '-') }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <a href="{{ route('Pengambilan_dan_Pengembalian', ['kode_rental' => $detail->kode_rental]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
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

            <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                <p class="text-xs text-gray-500">Menampilkan {{ isset($details) ? $details->count() : 0 }} dari {{ isset($details) ? $details->total() : 0 }} transaksi</p>
                <p class="text-xs text-gray-500">Halaman {{ isset($details) ? $details->currentPage() : 1 }} dari {{ isset($details) ? $details->lastPage() : 1 }}</p>
            </div>
            <div class="px-4 py-3">
                @if(isset($details))
                    {{ $details->links() }}
                @endif
            </div>
        </div>

    </div>
</x-app-layout>