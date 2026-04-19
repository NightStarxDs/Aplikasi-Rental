<x-app-layout>
    <body class="bg-gray-100">

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Transaksi Penyewaan</h1>

    <!-- Search & Filter -->
    <div class="flex gap-2 mb-4">
        <div class="relative w-full">
            <input type="text" class="w-full p-2 pl-10 border rounded-lg" placeholder="Cari Kode Transaksi">
            <span class="absolute left-3 top-2.5 text-gray-500">🔍</span>
        </div>

        <select class="p-2 border rounded-lg">
            <option>Status</option>
            <option>Diproses</option>
            <option>Disewa</option>
            <option>Selesai</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th class="px-2 py-2 border">No</th>
                    <th class="px-2 py-2 border">Kode Transaksi</th>
                    <th class="px-2 py-2 border">Nama Pelanggan</th>
                    <th class="px-2 py-2 border">Tanggal Sewa</th>
                    <th class="px-2 py-2 border">Tanggal Kembali</th>
                    <th class="px-2 py-2 border">Total Harga</th>
                    <th class="px-2 py-2 border">Status Transaksi</th>
                    <th class="px-2 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 10; $i++)
                <tr class="bg-white border">
                    <td class="px-2 py-2 border">{{ $i }}</td>
                    <td class="px-2 py-2 border">TRX00{{ $i }}</td>
                    <td class="px-2 py-2 border">Pelanggan {{ $i }}</td>
                    <td class="px-2 py-2 border">2026-04-01</td>
                    <td class="px-2 py-2 border">2026-04-05</td>
                    <td class="px-2 py-2 border">Rp 500.000</td>
                    <td class="px-2 py-2 border">
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Diproses</span>
                    </td>
                    <td class="px-2 py-2 border">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Edit</button>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
