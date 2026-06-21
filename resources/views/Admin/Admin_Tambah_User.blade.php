<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Tambah Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Tambahkan pengguna baru</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">

            {{-- ── Tampilkan semua error validasi (opsional, bisa dihapus jika sudah ada per-field) ── --}}
            @if($errors->any())
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
                    <p class="font-medium mb-1">Terdapat kesalahan pada input:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- ── ID User (read-only, tidak dikirim ke server) ── --}}
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-gray-500">ID User</label>
                        <input type="text"
                            value="Auto Generated"
                            disabled
                            class="w-full px-3 py-2 text-sm bg-gray-100 border border-gray-200
                                    rounded-lg text-gray-400 cursor-not-allowed">
                    </div>

                    {{-- ── Role ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="role" class="text-xs font-medium text-gray-500">
                            Role User
                        </label>
                        <select id="role" name="role"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg text-gray-800
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition cursor-pointer
                                    {{ $errors->has('role') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            <option value="admin"
                                {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="user"
                                {{ old('role') === 'user' ? 'selected' : '' }}>
                                User
                            </option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── Nama ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="name" class="text-xs font-medium text-gray-500">
                            Nama Pengguna
                        </label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: John Doe"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg
                                    text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition
                                    {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @error('name')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── No Telepon ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="telepon" class="text-xs font-medium text-gray-500">
                            No Telepon
                        </label>
                        <input type="text" id="telepon" name="telepon"
                            value="{{ old('telepon') }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg
                                    text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition
                                    {{ $errors->has('telepon') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @error('telepon')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── Email ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="email" class="text-xs font-medium text-gray-500">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="Contoh: user@mail.com"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg
                                    text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition
                                    {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @error('email')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── Alamat ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="alamat" class="text-xs font-medium text-gray-500">
                            Alamat
                        </label>
                        <input type="text" id="alamat" name="alamat"
                            value="{{ old('alamat') }}"
                            placeholder="Contoh: Batam"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg
                                    text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition
                                    {{ $errors->has('alamat') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @error('alamat')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── Password ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-xs font-medium text-gray-500">
                            Password
                        </label>
                        <input type="password" id="password" name="password"
                            value="{{ old('password') }}"
                            placeholder="Masukkan password..."
                            class="w-full px-3 py-2 text-sm bg-white border rounded-lg
                                    text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition
                                    {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        @error('password')
                            <p class="text-xs text-red-500 mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ── Konfirmasi Password ── --}}
                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation" class="text-xs font-medium text-gray-500">
                            Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation"
                            name="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                            placeholder="Ulangi password..."
                            class="w-full px-3 py-2 text-sm bg-white border border-gray-200
                                    rounded-lg text-gray-800 placeholder-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-emerald-500/20
                                    focus:border-emerald-500 transition">
                    </div>

                </div>

                {{-- ── Tombol Aksi ── --}}
                <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200">

                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                                text-gray-500 border border-gray-200 rounded-lg
                                hover:bg-gray-100 hover:text-gray-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                                text-white bg-emerald-600 border border-emerald-600 rounded-lg
                                hover:bg-emerald-700 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Tambah User
                    </button>

                </div>

            </form>
        </div>
    </div>

</x-app-layout>