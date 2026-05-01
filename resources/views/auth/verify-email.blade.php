<x-guest-layout>
    <div id="auth-root" class="font-auth flex min-h-screen items-center justify-center bg-emerald-50 p-6">
        <div class="w-full max-w-md">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-100 px-4 py-3 text-center text-sm font-medium text-emerald-800">
                    Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.
                </div>
            @endif

            <section class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-6 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold uppercase tracking-widest text-emerald-900">Verifikasi Email</h1>
                    <p class="mt-3 text-sm leading-relaxed text-emerald-700">
                        Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang lain.
                    </p>
                </div>

                <div class="mt-6 flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto flex-1">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-xl border border-emerald-800 bg-emerald-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                            Kirim Ulang Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto flex-1">
                        @csrf
                        <button type="submit" 
                            class="flex w-full items-center justify-center rounded-xl border border-emerald-300 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                            Log Out
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>
