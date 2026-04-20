<x-guest-layout>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
@endpush

<style>
    #auth-root { font-family: 'Plus Jakarta Sans', sans-serif; }
    .panel { transition: opacity 0.32s ease; }
    .slide-in      { animation: sfr 0.48s cubic-bezier(0.22,1,0.36,1) forwards; }
    .slide-in-left { animation: sfl 0.48s cubic-bezier(0.22,1,0.36,1) forwards; }
    @keyframes sfr { from { transform:translateX(56px); opacity:0; } to { transform:translateX(0); opacity:1; } }
    @keyframes sfl { from { transform:translateX(-56px); opacity:0; } to { transform:translateX(0); opacity:1; } }
    input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 30px #f0fdf4 inset !important;
        -webkit-text-fill-color: #064e3b !important;
    }
</style>

<div id="auth-root" class=" bg-emerald-50 flex items-center justify-center p-4">
    <div id="authCard"
         class="w-full max-w-2xl rounded-2xl overflow-hidden shadow-xl flex border border-emerald-100"
         style="min-height:340px;">

        {{-- ========== PANEL LOGIN (kiri) ========== --}}
        <div id="panelLogin" class="panel flex w-1/2 bg-white flex-col justify-center p-8 slide-in-left">
            <h1 class="text-xl font-bold text-emerald-900 tracking-widest text-center mb-6 uppercase">Masuk</h1>

            @if (session('status'))
                <div class="flex items-center p-3 mb-4 text-xs text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200">
                    <svg class="w-4 h-4 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <div class="flex items-center gap-2 bg-emerald-50 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }} rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                        </svg>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="Nama Pengguna / Email" required autofocus autocomplete="username"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <div class="flex items-center gap-2 bg-emerald-50 border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }} rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        <input id="password" type="password" name="password" placeholder="Kata Sandi"
                            required autocomplete="current-password"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                        <button type="button" onclick="togglePw('password')" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember + Lupa --}}
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 text-emerald-600 border-emerald-300 rounded focus:ring-emerald-400" />
                        <label for="remember_me" class="text-xs text-emerald-600 cursor-pointer">Ingat saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-emerald-500 hover:underline font-medium">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <div class="flex gap-2">
                    <button type="button" onclick="switchToRegister()"
                        class="flex-1 py-2.5 rounded-lg border border-emerald-200 text-emerald-600 text-sm font-semibold hover:bg-emerald-50 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-200">
                        Kembali
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-lg bg-emerald-800 text-white text-sm font-semibold hover:bg-emerald-700 active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-emerald-400">
                        Masuk
                    </button>
                </div>
            </form>
        </div>

        {{-- ========== PANEL INFO LOGIN (kanan) ========== --}}
        <div id="panelInfoLogin" class="panel flex w-1/2 bg-emerald-900 flex-col justify-center p-8 slide-in">
            <span class="inline-block bg-emerald-700 text-emerald-200 text-xs font-semibold px-3 py-1 rounded-full tracking-widest uppercase w-fit mb-3">
                Website
            </span>
            <h2 class="text-2xl font-bold text-white leading-snug mb-3">Selamat<br>Datang Di<br>Website</h2>
            <p class="text-emerald-300 text-sm leading-relaxed mb-6">
                Siap untuk pengalaman baru? Yuk, buat akunmu dan mulai jelajahi!
            </p>
            <button onclick="switchToRegister()"
                class="w-fit text-sm font-semibold px-5 py-2 rounded-lg border border-emerald-400 text-emerald-200 hover:bg-emerald-700 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-400">
                Daftar Sekarang
            </button>
        </div>

        {{-- ========== PANEL INFO REGISTER (kiri, hidden) ========== --}}
        <div id="panelInfoRegister" class="panel hidden w-1/2 bg-emerald-900 flex-col justify-center p-8">
            <span class="inline-block bg-emerald-700 text-emerald-200 text-xs font-semibold px-3 py-1 rounded-full tracking-widest uppercase w-fit mb-3">
                Website
            </span>
            <h2 class="text-2xl font-bold text-white leading-snug mb-3">Selamat<br>Datang Di<br>Website</h2>
            <p class="text-emerald-300 text-sm leading-relaxed mb-6">
                Silakan masuk untuk melanjutkan aktivitas dan menikmati layanan fitur lengkap kami.
            </p>
            <button onclick="switchToLogin()"
                class="w-fit text-sm font-semibold px-5 py-2 rounded-lg border border-emerald-400 text-emerald-200 hover:bg-emerald-700 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-400">
                Masuk Sekarang
            </button>
        </div>

        {{-- ========== PANEL FORM REGISTER (hidden) ========== --}}
        <div id="panelRegister" class="panel hidden w-1/2 bg-white flex-col justify-center p-8">
            <h1 class="text-xl font-bold text-emerald-900 tracking-widest text-center mb-6 uppercase">Daftar</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <div class="flex items-center gap-2 bg-emerald-50 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }} rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                        </svg>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Pengguna"
                            required autocomplete="name"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                    </div>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <div class="flex items-center gap-2 bg-emerald-50 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }} rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email"
                            required autocomplete="username"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                    </div>
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <div class="flex items-center gap-2 bg-emerald-50 border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }} rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        <input id="reg-password" type="password" name="password" placeholder="Kata Sandi"
                            required autocomplete="new-password"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                        <button type="button" onclick="togglePw('reg-password')" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Konfirmasi --}}
                <div class="mb-4">
                    <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 rounded-lg px-3 h-11 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition-all">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                            required autocomplete="new-password"
                            class="flex-1 bg-transparent border-none outline-none text-emerald-900 text-sm placeholder-emerald-300 font-medium focus:ring-0" />
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="button" onclick="switchToLogin()"
                        class="flex-1 py-2.5 rounded-lg border border-emerald-200 text-emerald-600 text-sm font-semibold hover:bg-emerald-50 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-200">
                        Kembali
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-lg bg-emerald-800 text-white text-sm font-semibold hover:bg-emerald-700 active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-emerald-400">
                        Daftar
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
@endpush

<script>
    function show(id, animClass) {
        const el = document.getElementById(id);
        el.classList.remove('hidden');
        el.classList.add('flex');
        el.style.opacity = '0';
        requestAnimationFrame(() => requestAnimationFrame(() => {
            el.classList.remove('slide-in', 'slide-in-left');
            void el.offsetWidth;
            el.classList.add(animClass);
            el.style.opacity = '1';
        }));
    }

    function hide(id) {
        const el = document.getElementById(id);
        el.style.opacity = '0';
        return el;
    }

    function switchToRegister() {
        hide('panelLogin');
        hide('panelInfoLogin');
        setTimeout(() => {
            document.getElementById('panelLogin').classList.add('hidden');    document.getElementById('panelLogin').classList.remove('flex');
            document.getElementById('panelInfoLogin').classList.add('hidden'); document.getElementById('panelInfoLogin').classList.remove('flex');
            show('panelInfoRegister', 'slide-in-left');
            show('panelRegister', 'slide-in');
        }, 270);
    }

    function switchToLogin() {
        hide('panelInfoRegister');
        hide('panelRegister');
        setTimeout(() => {
            document.getElementById('panelInfoRegister').classList.add('hidden'); document.getElementById('panelInfoRegister').classList.remove('flex');
            document.getElementById('panelRegister').classList.add('hidden');     document.getElementById('panelRegister').classList.remove('flex');
            show('panelLogin', 'slide-in-left');
            show('panelInfoLogin', 'slide-in');
        }, 270);
    }

    function togglePw(id) {
        const inp = document.getElementById(id);
        if (inp) inp.type = inp.type === 'password' ? 'text' : 'password';
    }
</script>

</x-guest-layout>