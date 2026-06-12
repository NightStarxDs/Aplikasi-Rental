<x-app3-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <div class="bg-white rounded-2xl border border-emerald-100 shadow-[0_4px_20px_-4px_rgba(16,185,129,0.05)] overflow-hidden relative">
                <!-- Decorative subtle glow -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50 z-0 transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                
                <div class="px-6 sm:px-10 py-8 border-t-[3px] border-emerald-500 relative z-10">
                    <div class="flex items-center gap-5 mb-8">
                        <div class="w-16 h-16 rounded-full bg-emerald-50 border border-emerald-200 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-8 h-8 text-emerald-600 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-4.418 3.582-8 8-8s8 3.582 8 8"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-emerald-600 font-medium mt-0.5">Pengaturan Informasi Akun</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mb-5">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Edit Profil</h3>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5 pl-1">Nama Lengkap</label>
                                <input id="name" name="name" type="text"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    placeholder="Masukkan nama lengkap" required />
                                <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5 pl-1">Alamat Email</label>
                                <input id="email" name="email" type="email"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    placeholder="Masukkan alamat email" required />
                                <x-input-error class="mt-1.5" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5 pl-1">Nomor Telepon</label>
                                <input id="telepon" name="telepon" type="text"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm"
                                    value="{{ old('telepon', Auth::user()->telepon) }}"
                                    placeholder="Masukkan nomor telepon aktif" />
                                <x-input-error class="mt-1.5" :messages="$errors->get('telepon')" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5 pl-1">Alamat Rumah</label>
                                <input id="alamat" name="alamat" type="text"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm"
                                    value="{{ old('alamat', Auth::user()->alamat) }}"
                                    placeholder="Masukkan alamat lengkap" />
                                <x-input-error class="mt-1.5" :messages="$errors->get('alamat')" />
                            </div>
                        </div>

                        <div class="border-t border-gray-100 mt-8 pt-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="w-full sm:w-auto h-10 flex items-center">
                                @if (session('status') === 'profile-updated')
                                    <div x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 3000)"
                                        class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-sm font-medium border border-emerald-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ __('Perubahan berhasil disimpan.') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit"
                                class="w-full sm:w-auto flex justify-center items-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] overflow-hidden">
                <div class="px-6 sm:px-10 py-8 border-t-[3px] border-gray-300">
                    <div class="flex items-center gap-3 mb-1">
                        <div class="p-2 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-800">Ubah Kata Sandi</h3>
                            <p class="text-sm text-gray-500 mt-0.5">Pastikan kata sandi baru cukup kuat dan tidak mudah ditebak.</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 [&>section>header]:hidden">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-red-100 shadow-[0_4px_20px_-4px_rgba(239,68,68,0.05)] overflow-hidden relative">
                <!-- Decorative glow -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full blur-3xl opacity-50 z-0 transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                
                <div class="px-6 sm:px-10 py-8 border-t-[3px] border-red-500 relative z-10">
                    <div class="flex items-center gap-3 mb-1">
                        <div class="p-2 bg-red-50 rounded-lg border border-red-100">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-800">Hapus Akun</h3>
                            <p class="text-sm text-gray-500 mt-0.5">Setelah akun dihapus, semua data tidak dapat dipulihkan. Pastikan Anda yakin.</p>
                        </div>
                    </div>

                    <div class="mt-6 [&>section>header]:hidden">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app3-layout>
