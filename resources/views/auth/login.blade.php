<x-guest-layout>

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
@endpush

<style>
    #auth-root input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 30px #f0fdf4 inset !important;
        -webkit-text-fill-color: #064e3b !important;
    }

    /* ── Auth Panel: desktop = absolute 50%, mobile = full width relative ── */
    .auth-panel {
        position: absolute;
        top: 0;
        height: 100%;
        width: 50%;
        flex-direction: column;
        justify-content: center;
        padding: 3rem 2.75rem;
    }

    /* Mobile override: full width, relative positioning */
    @media (max-width: 767px) {
        #auth-root > div {
            min-height: 100svh;
            border-radius: 0;
        }

        /* Sembunyikan panel info secara paksa di mobile (menghindari bocor display flex) */
        #panel-info {
            display: none !important;
        }

        .auth-panel {
            position: relative !important;
            width: 100% !important;
            left: auto !important;
            right: auto !important;
            height: auto !important;
            padding: 2rem 1.5rem !important;
        }

        /* Sembunyikan panel yang tidak aktif di mobile */
        .auth-panel.mobile-hidden {
            display: none !important;
        }
    }
</style>

@php
    $isRegisterError = $errors->has('name') || old('name') || $errors->has('password_confirmation');
    $hasLoginError = !$isRegisterError && ($errors->has('email') || $errors->has('password'));
    $hasRegisterError = $isRegisterError && $errors->any();
@endphp

<div id="auth-root" class="font-auth flex min-h-screen items-center justify-center bg-emerald-50 p-4 md:p-6">
    <div class="relative w-full max-w-3xl min-h-auth-card overflow-hidden rounded-2xl border border-emerald-100 shadow-auth-card">

        {{-- ══════════ FORM LOGIN ══════════ --}}
        <div id="panel-form-login"
            class="auth-panel flex right-0 left-auto {{ $isRegisterError ? 'z-[1] mobile-hidden' : 'z-[2]' }} bg-white">
            <div id="auth-login-inner" class="{{ $isRegisterError ? 'pointer-events-none opacity-0' : '' }}">
                <h1 class="mb-7 text-center text-xl font-bold uppercase tracking-widest text-emerald-900">Masuk</h1>

                @if (session('status'))
                    <div class="mb-4 flex items-center rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-xs text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3.5">
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ $hasLoginError ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                            </svg>
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email atau Nama Pengguna"
                                required autofocus autocomplete="username"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                        </div>
                    </div>

                    <div class="mb-3.5">
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ $hasLoginError ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                            <input id="pw-login" type="password" name="password" placeholder="Kata Sandi"
                                required autocomplete="current-password"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                            <button type="button" onclick="togglePw('pw-login')" class="text-emerald-400 transition-colors hover:text-emerald-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>
                        </div>
                        @if(!$isRegisterError && $errors->has('password')) <p class="mt-1 text-xs text-red-500">{{ $errors->first('password') }}</p> @endif
                        @if(!$isRegisterError && $errors->has('email')) <p class="mt-1 text-xs text-red-500">{{ $errors->first('email') }}</p> @endif
                    </div>

                    <div class="mb-6 flex items-center justify-between">
                        <label class="flex cursor-pointer items-center gap-2 text-xs text-emerald-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-emerald-300 text-emerald-600 focus:ring-emerald-400" />
                            Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-emerald-500 hover:underline">Lupa Password?</a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-emerald-800 py-3 text-sm font-semibold text-white transition-all hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                        Masuk
                    </button>

                    <!-- Mobile toggle -->
                    <div class="mt-6 text-center md:hidden">
                        <p class="text-sm text-emerald-600">Belum punya akun? <button type="button" onclick="switchToRegister()" class="font-bold hover:underline">Daftar Sekarang</button></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- FORM REGISTER -->
        <div id="panel-form-register"
            class="auth-panel flex left-0 right-auto {{ $isRegisterError ? 'z-[2]' : 'z-[1] mobile-hidden' }} bg-white">
            <div id="auth-register-inner" class="{{ $isRegisterError ? '' : 'pointer-events-none opacity-0' }}">
                <h1 class="mb-7 text-center text-xl font-bold uppercase tracking-widest text-emerald-900">Daftar</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3.5">
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ ($isRegisterError && $errors->has('name')) ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                            </svg>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Pengguna"
                                required autocomplete="name"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                        </div>
                        @if($isRegisterError && $errors->has('name')) <p class="mt-1 text-xs text-red-500">{{ $errors->first('name') }}</p> @endif
                    </div>

                    <div class="mb-3.5">
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ ($isRegisterError && $errors->has('email')) ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email"
                                required autocomplete="username"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                        </div>
                        @if($isRegisterError && $errors->has('email')) <p class="mt-1 text-xs text-red-500">{{ $errors->first('email') }}</p> @endif
                    </div>

                    <div class="mb-3.5">
                        <div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ ($isRegisterError && ($errors->has('password') || $errors->has('password_confirmation'))) ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                            <input id="pw-reg" type="password" name="password" placeholder="Kata Sandi"
                                required autocomplete="new-password"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                            <button type="button" onclick="togglePw('pw-reg')" class="text-emerald-400 transition-colors hover:text-emerald-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex h-12 items-center gap-2 rounded-xl border {{ ($isRegisterError && ($errors->has('password') || $errors->has('password_confirmation'))) ? 'border-red-400 bg-red-50' : 'border-emerald-200 bg-emerald-50' }} px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100">
                            <svg class="h-4 w-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                                required autocomplete="new-password"
                                class="flex-1 border-none bg-transparent text-sm font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0" />
                        </div>
                        @if($isRegisterError && $errors->has('password')) <p class="mt-1 text-xs text-red-500">{{ $errors->first('password') }}</p> @endif
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-emerald-800 py-3 text-sm font-semibold text-white transition-all hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95">
                        Daftar
                    </button>

                    <!-- Mobile toggle -->
                    <div class="mt-6 text-center md:hidden">
                        <p class="text-sm text-emerald-600">Sudah punya akun? <button type="button" onclick="switchToLogin()" class="font-bold hover:underline">Masuk Sekarang</button></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- PANEL INFO (hanya tampil di desktop md+) -->
        <div id="panel-info" class="auth-panel hidden md:flex {{ $isRegisterError ? 'left-auto right-0' : 'left-0 right-auto' }} z-10 overflow-hidden bg-emerald-900">
            {{-- Background image --}}
            <div class="pointer-events-none absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ asset('images/kamera-login.jpg') }}');"></div>

            {{-- Overlay emerald gelap --}}
            <div class="pointer-events-none absolute inset-0 bg-emerald-900/80"></div>

            {{-- Konten harus relative agar muncul di atas overlay --}}
            <div class="relative z-10">

            <div id="info-login" class="{{ $isRegisterError ? 'hidden' : '' }}">
                <span class="mb-4 inline-block w-fit rounded-full bg-emerald-800 px-3 py-1 text-xs font-semibold text-emerald-300">Masuk</span>
                <h2 class="mb-3 text-3xl font-bold leading-snug text-white">Selamat<br>Datang Di<br><span class="text-white font-bold bg-gradient-to-r from-emerald-500 to-emerald-700 px-2 rounded-lg">OUTRENT</span></h2>
                <p class="mb-7 text-sm leading-relaxed text-emerald-300">Siap untuk pengalaman baru? Yuk, buat akunmu dan mulai jelajahi!</p>
                <button type="button" onclick="switchToRegister()"
                    class="w-fit rounded-xl border border-emerald-400 px-6 py-2.5 text-sm font-semibold text-emerald-200 transition-colors hover:bg-emerald-800 focus:outline-none">
                    Daftar Sekarang
                </button>
            </div>

            <div id="info-register" class="{{ $isRegisterError ? '' : 'hidden' }}">
                <span class="mb-4 inline-block w-fit rounded-full bg-emerald-800 px-3 py-1 text-xs font-semibold text-emerald-300">Daftar</span>
                <h2 class="mb-3 text-3xl font-bold leading-snug text-white">Kamu<br>Sudah Punya<br>Akun?</h2>
                <p class="mb-7 text-sm leading-relaxed text-emerald-300">Silakan masuk untuk melanjutkan dan menikmati semua fitur kami.</p>
                <button type="button" onclick="switchToLogin()"
                    class="w-fit rounded-xl border border-emerald-400 px-6 py-2.5 text-sm font-semibold text-emerald-200 transition-colors hover:bg-emerald-800 focus:outline-none">
                    Masuk Sekarang
                </button>
            </div>
        </div>
    </div> {{-- end relative z-10 --}}
</div> {{-- end panel-info --}}
</div>
</div>


<script>
    const panelInfo = document.getElementById('panel-info');
    const fLogin = document.getElementById('panel-form-login');
    const fReg = document.getElementById('panel-form-register');
    const loginInner = document.getElementById('auth-login-inner');
    const regInner = document.getElementById('auth-register-inner');
    const iLogin = document.getElementById('info-login');
    const iReg = document.getElementById('info-register');

    let busy = false;
    let isRegister = {{ $isRegisterError ? 'true' : 'false' }};

    const AUTH_PANEL_ANIMS = ['animate-auth-panel-right', 'animate-auth-panel-left'];

    function clearPanelMotion() {
        panelInfo.classList.remove(...AUTH_PANEL_ANIMS);
        panelInfo.style.transform = '';
        panelInfo.style.animation = '';
    }

    function runPanelSlide(direction) {
        clearPanelMotion();
        void panelInfo.offsetWidth;
        panelInfo.classList.add(direction === 'right' ? 'animate-auth-panel-right' : 'animate-auth-panel-left');
    }

    function runFormFade(el, direction) {
        el.classList.remove('animate-auth-fade-in', 'animate-auth-fade-out');
        el.style.removeProperty('animation');
        void el.offsetWidth;
        if (direction === 'in') {
            el.classList.remove('pointer-events-none', 'opacity-0');
        }
        void el.offsetWidth;
        el.classList.add(direction === 'in' ? 'animate-auth-fade-in' : 'animate-auth-fade-out');
        if (direction === 'out') {
            window.setTimeout(() => el.classList.add('pointer-events-none'), 360);
        }
    }

    function anchorPanelLeft() {
        panelInfo.classList.remove('left-auto', 'right-0');
        panelInfo.classList.add('left-0', 'right-auto');
    }

    function anchorPanelRight() {
        panelInfo.classList.remove('left-0', 'right-auto');
        panelInfo.classList.add('left-auto', 'right-0');
    }

    function switchToRegister() {
        if (busy || isRegister) return;
        busy = true;
        isRegister = true;

        fReg.style.zIndex = '2';
        fLogin.style.zIndex = '1';

        // Mobile: swap visibility
        fLogin.classList.add('mobile-hidden');
        fReg.classList.remove('mobile-hidden');

        anchorPanelLeft();
        runFormFade(loginInner, 'out');
        window.setTimeout(() => runFormFade(regInner, 'in'), 140);
        runPanelSlide('right');

        window.setTimeout(() => {
            iLogin.classList.add('hidden');
            iReg.classList.remove('hidden');
        }, 300);

        window.setTimeout(() => {
            clearPanelMotion();
            anchorPanelRight();
            busy = false;
        }, 620);
    }

    function switchToLogin() {
        if (busy || !isRegister) return;
        busy = true;
        isRegister = false;

        fLogin.style.zIndex = '2';
        fReg.style.zIndex = '1';

        // Mobile: swap visibility
        fReg.classList.add('mobile-hidden');
        fLogin.classList.remove('mobile-hidden');

        anchorPanelRight();
        runFormFade(regInner, 'out');
        window.setTimeout(() => runFormFade(loginInner, 'in'), 140);
        runPanelSlide('left');

        window.setTimeout(() => {
            iLogin.classList.remove('hidden');
            iReg.classList.add('hidden');
        }, 300);

        window.setTimeout(() => {
            clearPanelMotion();
            anchorPanelLeft();
            regInner.classList.remove('animate-auth-fade-in', 'animate-auth-fade-out');
            regInner.style.removeProperty('animation');
            regInner.classList.add('opacity-0', 'pointer-events-none');
            busy = false;
        }, 620);
    }


    function togglePw(id) {
        const el = document.getElementById(id);
        if (el) el.type = el.type === 'password' ? 'text' : 'password';
    }
</script>

</x-guest-layout>
