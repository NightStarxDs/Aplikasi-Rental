<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Manajemen Inventaris Barang') }}
        </h1>
    </x-slot>

    <body class="bg-gray-100">

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Inventaris</h1>

        <!-- Button -->
        <button class="mb-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
            Tambah Data Barang
        </button>

        <!-- Search & Filter -->
        <div class="flex gap-2 mb-4">
            <div class="relative w-full">
                <input type="text" class="w-full p-2 pl-10 border rounded-lg" placeholder="Cari Barang">
                <span class="absolute left-3 top-2.5 text-gray-500">
                    🔍
                </span>
            </div>

            <select class="p-2 border rounded-lg">
                <option>Kategori</option>
                <option>Kamera</option>
                <option>Camping</option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th class="px-2 py-2 border">No</th>
                        <th class="px-2 py-2 border">Gambar</th>
                        <th class="px-2 py-2 border">Nama Barang</th>
                        <th class="px-2 py-2 border">Deskripsi</th>
                        <th class="px-2 py-2 border">Kategori</th>
                        <th class="px-2 py-2 border">Harga</th>
                        <th class="px-2 py-2 border">Stok</th>
                        <th class="px-2 py-2 border">Status</th>
                        <th class="px-2 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                    <tr class="bg-white border">
                        <td class="px-2 py-2 border">{{ $i }}</td>
                        <td class="px-2 py-2 border">
                            <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded" />
                        </td>
                        <td class="px-2 py-2 border">Barang {{ $i }}</td>
                        <td class="px-2 py-2 border">Deskripsi barang</td>
                        <td class="px-2 py-2 border">Kamera</td>
                        <td class="px-2 py-2 border">Rp 100.000</td>
                        <td class="px-2 py-2 border">10</td>
                        <td class="px-2 py-2 border">
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
                        </td>
     </body>            <td class="px-2 py-2 border">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

</x-app-layout>

