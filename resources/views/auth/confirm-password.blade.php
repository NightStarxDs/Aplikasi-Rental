<x-guest-layout>
    <div id="auth-root" class="font-auth flex min-h-screen items-center justify-center bg-emerald-50 p-6" x-data="{ showPassword: false }">
        <div class="w-full max-w-md">
            <section class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-bold uppercase tracking-widest text-emerald-900">Konfirmasi Password</h1>
                    <p class="mt-2 text-sm text-emerald-700">Area ini aman. Harap konfirmasi password Anda sebelum melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-emerald-700">Password</label>
                        <div class="relative">
                            <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                class="w-full rounded-xl border border-emerald-200 bg-white py-2 pl-3 pr-10 text-sm font-medium text-emerald-900 placeholder-emerald-300 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100"
                                placeholder="Masukkan password Anda">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-emerald-500 transition hover:bg-emerald-100 hover:text-emerald-700"
                                :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10z"/>
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-xl border border-emerald-800 bg-emerald-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                            KONFIRMASI
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-guest-layout>
