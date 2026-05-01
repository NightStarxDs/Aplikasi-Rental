<x-guest-layout>
    <div id="auth-root" class="font-auth flex min-h-screen items-center justify-center bg-emerald-50 p-6">
        <div class="w-full max-w-md">
            <x-auth-session-status class="mb-4 rounded-lg border border-emerald-200 bg-emerald-100 px-4 py-3 text-sm text-emerald-800" :status="session('status')" />

            <section class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-bold uppercase tracking-widest text-emerald-900">Lupa Password</h1>
                    <p class="mt-2 text-sm text-emerald-700">Masukkan email untuk menerima kode OTP / reset password.</p>
                </div>

                <div class="mt-6 flex justify-center gap-2 sm:gap-3">
                    @foreach (range(1, 5) as $otp)
                        <input
                            type="text"
                            maxlength="1"
                            inputmode="numeric"
                            class="h-11 w-11 rounded-lg border border-emerald-200 bg-emerald-50 text-center text-lg font-semibold text-emerald-800 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100"
                            placeholder="-">
                    @endforeach
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-emerald-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-emerald-900 placeholder-emerald-300 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100"
                            placeholder="Masukkan email aktif">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <div class="flex items-center justify-between gap-2 pt-2">
                        <a href="{{ route('login') }}"
                            class="inline-flex min-w-24 flex-1 items-center justify-center rounded-xl border border-emerald-300 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">
                            KEMBALI
                        </a>
                        <button type="submit"
                            class="inline-flex min-w-24 flex-1 items-center justify-center rounded-xl border border-emerald-800 bg-emerald-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                            LANJUT
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-guest-layout>
