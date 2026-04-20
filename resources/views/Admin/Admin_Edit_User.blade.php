<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Edit Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui data akun pengguna</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">

            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- ID User (readonly) --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">ID User</label>
                        <input type="text" value="USR001" disabled
                            class="w-full px-3 py-2 text-sm bg-gray-100 border border-gray-200 rounded-lg text-gray-400 cursor-not-allowed">
                    </div>

                    {{-- Role --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">Role User</label>
                        <select name="role"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition cursor-pointer">
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>

                    {{-- Nama --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">Nama Pengguna</label>
                        <input type="text" name="name"
                            placeholder="Contoh: John Doe"
                            value="User 1"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- No Telepon --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">No Telepon</label>
                        <input type="text" name="phone"
                            placeholder="Contoh: 08123456789"
                            value="08123456789"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">Email</label>
                        <input type="email" name="email"
                            placeholder="Contoh: user@mail.com"
                            value="user1@mail.com"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Alamat --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">Alamat</label>
                        <input type="text" name="alamat"
                            placeholder="Contoh: Batam"
                            value="Batam"
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Password Baru --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">
                            Password Baru
                            <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span>
                        </label>
                        <input type="password" name="password"
                            placeholder="Masukkan password baru..."
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            placeholder="Ulangi password baru..."
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                    </div>

                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200">
                    <a href="{{ route('Kelola_User') }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>