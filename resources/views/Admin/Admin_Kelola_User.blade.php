<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h1>
    </x-slot>

 <body class="bg-gray-100">

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna</h1>

    <!-- Search -->
    <div class="flex mb-4">
        <div class="relative w-full max-w-md">
            <input type="text" class="w-full p-2 pl-10 border rounded-lg" placeholder="Cari Pengguna">
            <span class="absolute left-3 top-2.5 text-gray-500">🔍</span>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th class="px-2 py-2 border">No</th>
                    <th class="px-2 py-2 border">ID User</th>
                    <th class="px-2 py-2 border">Nama Pengguna</th>
                    <th class="px-2 py-2 border">No Telpon</th>
                    <th class="px-2 py-2 border">Email</th>
                    <th class="px-2 py-2 border">Alamat</th>
                    <th class="px-2 py-2 border">Role User</th>
                    <th class="px-2 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 10; $i++)
                <tr class="bg-white border">
                    <td class="px-2 py-2 border">{{ $i }}</td>
                    <td class="px-2 py-2 border">USR00{{ $i }}</td>
                    <td class="px-2 py-2 border">User {{ $i }}</td>
                    <td class="px-2 py-2 border">08123456789</td>
                    <td class="px-2 py-2 border">user{{ $i }}@mail.com</td>
                    <td class="px-2 py-2 border">Batam</td>
                    <td class="px-2 py-2 border">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Admin</span>
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
