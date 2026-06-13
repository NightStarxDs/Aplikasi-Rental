<x-guest-layout>
    <div id="auth-root" class="font-auth flex min-h-screen items-center justify-center bg-emerald-50 p-6">
        <div class="w-full max-w-md">

            <section class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-6 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold uppercase tracking-widest text-emerald-900">Lupa Password</h1>
                    <p class="mt-3 text-sm text-emerald-700 leading-relaxed">Lupa kata sandi Anda? Tidak masalah. Cukup masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800 text-center" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-emerald-800">Alamat Email</label>
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-5 w-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0 w-full"
                                placeholder="Masukkan email terdaftar">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
                    </div>

                    <div class="flex flex-col gap-3 pt-2">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center rounded-xl bg-emerald-800 py-3 text-sm font-bold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95 shadow-md">
                            Kirim Tautan Reset
                        </button>
                        <a href="{{ route('login') }}"
                            class="w-full inline-flex items-center justify-center rounded-xl border-2 border-emerald-100 bg-white py-2.5 text-sm font-bold text-emerald-700 transition hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                            Kembali ke Halaman Login
                        </a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-guest-layout>
