<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Kelola Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh data akun pengguna sistem</p>
            </div>

            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-emerald-800 hover:bg-emerald-900 rounded-lg transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        {{-- ── Flash Alert ── --}}
        @if(session('success'))
            <div class="mb-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- ── Search & Filter ── --}}
        <form method="GET" action="{{ route('admin.users.index') }}"
            class="flex items-center gap-2 mb-4">

            {{-- Input cari --}}
            <div class="flex flex-1 items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama pengguna atau email..."
                    class="flex-1 px-3 py-2 text-sm bg-white border border-gray-200 border-r-0
                           rounded-l-lg text-gray-800 placeholder-gray-400
                           focus:outline-none focus:border-emerald-500">
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                           text-white bg-emerald-800 hover:bg-emerald-900 rounded-r-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Cari
                </button>
            </div>

            {{-- Filter role --}}
            <select name="role" onchange="this.form.submit()"
                class="px-3 py-2 text-sm border border-gray-200 rounded-lg text-gray-700
                       focus:outline-none focus:border-emerald-500 bg-white">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user"  {{ request('role') === 'user'  ? 'selected' : '' }}>User</option>
            </select>

            {{-- Tombol reset --}}
            @if(request()->hasAny(['search', 'role']))
                <a href="{{ route('admin.users.index') }}"
                    class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 bg-gray-100
                           hover:bg-gray-200 rounded-lg transition">
                    Reset
                </a>
            @endif
        </form>

        {{-- ── Tabel ── --}}
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

                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nomor urut tetap benar meski pagination --}}
                        <td class="px-3 py-3 text-gray-400 text-xs">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        {{-- ID format USR001 --}}
                        <td class="px-3 py-3 font-medium text-gray-800 text-xs">
                            {{ $user->formatted_id }}
                        </td>

                        <td class="px-3 py-3 font-medium text-gray-800">{{ $user->name }}</td>

                        <td class="px-3 py-3 text-gray-600 text-xs">
                            {{ $user->telepon ?? '-' }}
                        </td>

                        <td class="px-3 py-3 text-gray-600 text-xs truncate" title="{{ $user->email }}">
                            {{ $user->email }}
                        </td>

                        <td class="px-3 py-3 text-gray-600 text-xs truncate" title="{{ $user->alamat }}">
                            {{ $user->alamat ?? '-' }}
                        </td>

                        <td class="px-3 py-3">
                            @if($user->role === 'admin')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                    User
                                </span>
                            @endif
                        </td>

                        <td class="px-3 py-3">
                            <div class="flex items-center justify-center gap-1.5">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.users.edit', $user->id_user) }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium
                                           bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Tombol Riwayat --}}
                                <a href="{{ route('admin.users.history', $user->id_user) }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium
                                           bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    Riwayat
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id_user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus pengguna {{ addslashes($user->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium
                                               bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="px-3 py-10 text-center text-gray-400 text-sm">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952
                                       4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07
                                       M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766
                                       l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0
                                       3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0
                                       015.25 0z"/>
                            </svg>
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

            {{-- ── Pagination Info ── --}}
            <div class="flex items-center justify-between px-4 py-3 border-t border-gray-100 bg-gray-50">
                <p class="text-xs text-gray-500">
                    @if($users->total() > 0)
                        Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }}
                        dari {{ $users->total() }} pengguna
                    @else
                        Tidak ada pengguna
                    @endif
                </p>
                <div class="text-xs text-gray-500">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>-