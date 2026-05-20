<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Kelola Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh data akun pengguna sistem</p>
            </div>
            
            <a href="{{ route('Tambah_User')}}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Pengguna
            </a>
        </div>

        
    </x-slot>

    <div class="py-6 px-6">

        {{-- Search --}}
        <div class="flex items-center mb-4">
            <input type="text" placeholder="Cari nama pengguna atau email..."
                class="flex-1 px-3 py-2 text-sm bg-white border border-gray-200 border-r-0 rounded-l-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-emerald-500">
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
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-10">No</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-20">ID</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-28">Nama</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-28">Telepon</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-36">Email</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-32">Alamat</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-20">Role</th>
                    <th class="px-2 py-3 text-xs font-medium text-gray-500 w-48 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">

                    {{-- 1 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">1</td>
                        <td class="px-3 py-3 font-medium text-gray-800">USR001</td>
                        <td class="px-3 py-3 font-medium text-gray-800">User 1</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">08123456789</td>
                        <td class="px-3 py-3 text-gray-600 text-xs truncate">user1@mail.com</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">Batam</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>Admin
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('Edit_User') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <a href="{{ route('Riwayat_Pelanggan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Riwayat
                                </a>
                                <button onclick="return confirm('Yakin hapus pengguna ini?')" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- 2 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">2</td>
                        <td class="px-3 py-3 font-medium text-gray-800">USR002</td>
                        <td class="px-3 py-3 font-medium text-gray-800">User 2</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">08123456789</td>
                        <td class="px-3 py-3 text-gray-600 text-xs truncate">user2@mail.com</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">Batam</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>User
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('Edit_User') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <a href="{{ route('Riwayat_Pelanggan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Riwayat
                                </a>
                                <button onclick="return confirm('Yakin hapus pengguna ini?')" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- 3 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">3</td>
                        <td class="px-3 py-3 font-medium text-gray-800">USR003</td>
                        <td class="px-3 py-3 font-medium text-gray-800">User 3</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">08123456789</td>
                        <td class="px-3 py-3 text-gray-600 text-xs truncate">user3@mail.com</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">Batam</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>User
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('Edit_User') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <a href="{{ route('Riwayat_Pelanggan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Riwayat
                                </a>
                                <button onclick="return confirm('Yakin hapus pengguna ini?')" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- 4 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">4</td>
                        <td class="px-3 py-3 font-medium text-gray-800">USR004</td>
                        <td class="px-3 py-3 font-medium text-gray-800">User 4</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">08123456789</td>
                        <td class="px-3 py-3 text-gray-600 text-xs truncate">user4@mail.com</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">Batam</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>Admin
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('Edit_User') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <a href="{{ route('Riwayat_Pelanggan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Riwayat
                                </a>
                                <button onclick="return confirm('Yakin hapus pengguna ini?')" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- 5 --}}
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-3 py-3 text-gray-400 text-xs">5</td>
                        <td class="px-3 py-3 font-medium text-gray-800">USR005</td>
                        <td class="px-3 py-3 font-medium text-gray-800">User 5</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">08123456789</td>
                        <td class="px-3 py-3 text-gray-600 text-xs truncate">user5@mail.com</td>
                        <td class="px-3 py-3 text-gray-600 text-xs">Batam</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>User
                            </span>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('Edit_User') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <a href="{{ route('Riwayat_Pelanggan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Riwayat
                                </a>
                                <button onclick="return confirm('Yakin hapus pengguna ini?')" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                <p class="text-xs text-gray-500">Menampilkan 10 dari 10 pengguna</p>
                <p class="text-xs text-gray-500">Halaman 1 dari 1</p>
            </div>
        </div>
    </div>
</x-app-layout>