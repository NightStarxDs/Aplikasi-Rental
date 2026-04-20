<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Manajemen Inventaris Barang</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh data barang dan stok tersedia</p>
            </div>

            <a href="{{ route('Tambah_Barang')}}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        {{-- Search & Filter --}}
        <div class="flex items-center mb-4">
            <select class="px-3 py-2 text-sm text-white bg-emerald-800 hover:bg-emerald-900 rounded-l-lg outline-none cursor-pointer">
                <option value="">Semua Kategori</option>
                <option value="kamera">Kamera</option>
                <option value="camping">Camping</option>
            </select>
            <input type="text" placeholder="Cari nama barang..."
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
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class=" text-center">
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-10">No</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-14">Foto</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-36">Nama Barang</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-36">Deskripsi</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Kategori</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Harga/Hari</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-14 text-center">Stok</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-24">Status</th>
                        <th class="px-3 py-3 text-xs font-medium text-gray-500 w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">

                    {{-- 1 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">1</td>
                        <td class="px-3 py-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        </td>
                        <td class="px-3 py-3 font-medium text-gray-800 truncate">Canon EOS R50</td>
                        <td class="px-3 py-3 text-gray-500 truncate">Kamera mirrorless ringan</td>
                        <td class="px-3 py-3"><span class="inline-block px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Kamera</span></td>
                        <td class="px-3 py-3 text-gray-700 text-xs">Rp 25.000</td>
                        <td class="px-3 py-3 text-center font-medium text-gray-800">5</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Tersedia
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <a href="{{ route('Detail_Barang')}}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>

                    {{-- 2 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">2</td>
                        <td class="px-3 py-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        </td>
                        <td class="px-3 py-3 font-medium text-gray-800 truncate">Tenda Dome 4P</td>
                        <td class="px-3 py-3 text-gray-500 truncate">Tenda camping 4 orang</td>
                        <td class="px-3 py-3"><span class="inline-block px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Camping</span></td>
                        <td class="px-3 py-3 text-gray-700 text-xs">Rp 50.000</td>
                        <td class="px-3 py-3 text-center font-medium text-gray-800">0</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-red-50 text-red-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>Habis
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <a href="{{ route('Detail_Barang')}}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>

                    {{-- 3 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">3</td>
                        <td class="px-3 py-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        </td>
                        <td class="px-3 py-3 font-medium text-gray-800 truncate">Sony A7 III</td>
                        <td class="px-3 py-3 text-gray-500 truncate">Full-frame mirrorless</td>
                        <td class="px-3 py-3"><span class="inline-block px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Kamera</span></td>
                        <td class="px-3 py-3 text-gray-700 text-xs">Rp 40.000</td>
                        <td class="px-3 py-3 text-center font-medium text-gray-800">0</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-red-50 text-red-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>Habis
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <a href="{{ route('Detail_Barang')}}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>

                    {{-- 4 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">4</td>
                        <td class="px-3 py-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        </td>
                        <td class="px-3 py-3 font-medium text-gray-800 truncate">Sleeping Bag</td>
                        <td class="px-3 py-3 text-gray-500 truncate">Kapasitas -5 derajat</td>
                        <td class="px-3 py-3"><span class="inline-block px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Camping</span></td>
                        <td class="px-3 py-3 text-gray-700 text-xs">Rp 15.000</td>
                        <td class="px-3 py-3 text-center font-medium text-gray-800">8</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Tersedia
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <a href="{{ route('Detail_Barang')}}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>

                    {{-- 5 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">5</td>
                        <td class="px-3 py-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        </td>
                        <td class="px-3 py-3 font-medium text-gray-800 truncate">DJI Osmo Pocket</td>
                        <td class="px-3 py-3 text-gray-500 truncate">Kamera action gimbal</td>
                        <td class="px-3 py-3"><span class="inline-block px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-600 rounded">Kamera</span></td>
                        <td class="px-3 py-3 text-gray-700 text-xs">Rp 20.000</td>
                        <td class="px-3 py-3 text-center font-medium text-gray-800">2</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Tersedia
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <a href="{{ route('Detail_Barang')}}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                <p class="text-xs text-gray-500">Menampilkan 10 dari 10 barang</p>
                <p class="text-xs text-gray-500">Halaman 1 dari 1</p>
            </div>
        </div>

    </div>
</x-app-layout>