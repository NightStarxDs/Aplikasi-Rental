<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Riwayat Pelanggan</h1>
                <p class="text-sm text-gray-500 mt-1">Detail identitas dan riwayat transaksi pelanggan</p>
            </div>     
        </div>
    </x-slot>

    <div class="py-6 px-6 space-y-5">

        {{-- Identitas Pelanggan --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Identitas Pelanggan</p>
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-center gap-4 mb-4">

                    {{-- Avatar --}}
                    <div class="w-14 h-14 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                        <span class="text-lg font-semibold text-emerald-700">U5</span>
                    </div>

                    <div>
                        <p class="text-base font-semibold text-gray-800">User 5</p>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>User
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 pt-4 border-t border-dashed border-gray-200">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">ID Pengguna</p>
                        <p class="text-sm font-medium text-gray-800">USR005</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">No Telepon</p>
                        <p class="text-sm font-medium text-gray-800">08123456789</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Email</p>
                        <p class="text-sm font-medium text-gray-800">user5@mail.com</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Alamat</p>
                        <p class="text-sm font-medium text-gray-800">Batam</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4 pt-4 border-t border-dashed border-gray-200">
                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Transaksi</p>
                        <p class="text-lg font-semibold text-gray-800">8</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Pengeluaran</p>
                        <p class="text-lg font-semibold text-emerald-700">Rp 3.850.000</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                        <p class="text-xs text-gray-400 mb-1">Total Denda</p>
                        <p class="text-lg font-semibold text-red-600">Rp 150.000</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Transaksi --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Riwayat Transaksi</p>
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left" style="table-layout:fixed;">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-10 text-center">No</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-24">ID Transaksi</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-28 text-center">Tgl Sewa</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-28 text-center">Tgl Kembali</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-20 text-center">Durasi</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500">Barang Disewa</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-28 text-center">Total</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-24 text-center">Denda</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-24 text-center">Status</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">

                        {{-- Row 1 --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">1</td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded">TRX001</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-04-01</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-04-05</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">4 Hari</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full">Canon EOS R50</span>
                                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">Tenda Dome 4P</span>
                                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">Sleeping Bag</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs font-medium text-gray-800 text-center">Rp 700.000</td>
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">Rp —</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Selesai
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('Pengambilan_dan_Pengembalian') }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">2</td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded">TRX004</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-03-10</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-03-13</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">3 Hari</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full">Sony A7 III</span>
                                    <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full">Tripod Carbon</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs font-medium text-gray-800 text-center">Rp 450.000</td>
                            <td class="px-4 py-3 text-xs font-medium text-red-600 text-center">Rp 50.000</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Selesai
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('Pengambilan_dan_Pengembalian') }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">3</td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded">TRX007</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-02-20</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-02-25</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">5 Hari</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">Tenda Dome 4P</span>
                                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">Sleeping Bag</span>
                                    <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full">Carrier 60L</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs font-medium text-gray-800 text-center">Rp 650.000</td>
                            <td class="px-4 py-3 text-xs font-medium text-red-600 text-center">Rp 100.000</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Selesai
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('Pengambilan_dan_Pengembalian') }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>

                        {{-- Row 4 --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">4</td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded">TRX011</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-01-15</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-01-17</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2 Hari</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full">DJI Osmo Pocket</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs font-medium text-gray-800 text-center">Rp 200.000</td>
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">Rp —</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Selesai
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('Pengambilan_dan_Pengembalian') }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>

                        {{-- Row 5 - Aktif --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">5</td>
                            <td class="px-4 py-3">
                                <span class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-0.5 rounded">TRX015</span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-04-18</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">2026-04-22</td>
                            <td class="px-4 py-3 text-xs text-gray-600 text-center">4 Hari</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full">Canon EOS R50</span>
                                    <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full">Tripod Carbon</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs font-medium text-gray-800 text-center">Rp 600.000</td>
                            <td class="px-4 py-3 text-xs text-gray-400 text-center">Rp —</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>Disewa
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('Pengambilan_dan_Pengembalian') }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                    <p class="text-xs text-gray-500">Menampilkan 5 dari 8 transaksi</p>
                    <p class="text-xs text-gray-500">Halaman 1 dari 2</p>
                </div>
            </div>
        </div>

        <a href="{{ route('Kelola_User') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
    </div>
</x-app-layout>