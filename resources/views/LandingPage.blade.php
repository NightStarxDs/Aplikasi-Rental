<x-app2-layout>
    <section class="w-full px-4 py-3" id='section-1'>
        <div class="relative mx-auto h-[calc(100svh-5rem-2rem)] w-full overflow-hidden rounded-2xl shadow-xl ring-1 ring-black/5">
            <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Gunung"
                class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/35 to-black/20"></div>

            <div class="absolute inset-0 flex items-center justify-center px-6 text-center text-white sm:px-10 lg:px-16">
                <div class="max-w-3xl">
                    <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">
                        Selamat Datang di <span class="text-green-400">Out</span>Rent
                    </h1>
                    <p class="mt-3 text-base text-white/90 sm:mt-4 sm:text-lg lg:text-2xl">
                        Solusi sewa alat camping dan kamera termudah.   
                    </p>

                    <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:mt-8 sm:flex-row sm:gap-5">
                        <x-primary-button href="" class="w-full px-6 py-2 text-sm sm:w-auto sm:text-base rounded-lg">
                            Belanja Sekarang
                        </x-primary-button>
                        <x-secondary-button class="w-full px-6 py-2 text-sm sm:w-auto sm:text-base rounded-lg">
                            Lihat Katalog
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-gradient-to-b from-white via-emerald-50/40 to-white px-4 py-14 sm:py-16" id='section-2'>
        <div class="mx-auto w-full max-w-7xl">
            <div class="mb-8 text-center sm:mb-10">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700/80">Kategori</p>
                <h2 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">Apa Yang Kami Jual?</h2>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600 sm:text-base">
                    Pilih kebutuhan petualangan dan fotografi kamu. Semua produk disiapkan dengan kualitas terbaik, simpel, dan siap pakai.
                </p>
            </div>

            <div class="relative">
                <button type="button" id="section2Prev"
                    class="absolute left-2 top-1/2 z-10 hidden -translate-y-1/2 rounded-lg border border-emerald-200 bg-transparent p-2.5 text-emerald-700 shadow-md transition hover:bg-emerald-600 lg:block"
                    aria-label="Slide sebelumnya">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="white">
                        <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div id="section2Track"
                    class="flex snap-x snap-mandatory gap-4 overflow-x-auto scroll-smooth pb-3 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    <article class="group relative min-w-[96%] snap-start overflow-hidden rounded-2xl border border-emerald-100 shadow-lg sm:min-w-[90%] lg:min-w-[86%]">
                        <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Alat Camping"
                            class="h-[380px] w-full object-cover sm:h-[450px] lg:h-[500px]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/35 to-black/10"></div>
                        <div class="absolute inset-0 flex flex-col justify-between p-5 text-white sm:p-7">
                            <p class="text-sm font-semibold text-white/90 sm:text-base">Kategori</p>
                            <div>
                                <h3 class="text-4xl font-bold leading-tight sm:text-5xl">Alat Camping</h3>
                                <p class="mt-1 text-lg text-white/90 sm:text-2xl">Mulai dari Rp99rb/hari</p>
                                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:gap-3">
                                    <a href="#"
                                        class="rounded-md bg-emerald-700 px-6 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-emerald-600">
                                        Order Now
                                    </a>
                                    <a href="#"
                                        class="rounded-md bg-white px-6 py-2.5 text-center text-sm font-semibold text-gray-800 transition hover:bg-gray-100">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="group relative min-w-[96%] snap-start overflow-hidden rounded-2xl border border-emerald-100 shadow-lg sm:min-w-[90%] lg:min-w-[86%]">
                        <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Kamera"
                            class="h-[380px] w-full object-cover sm:h-[450px] lg:h-[500px]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/35 to-black/10"></div>
                        <div class="absolute inset-0 flex flex-col justify-between p-5 text-white sm:p-7">
                            <p class="text-sm font-semibold text-white/90 sm:text-base">Kategori</p>
                            <div>
                                <h3 class="text-4xl font-bold leading-tight sm:text-5xl">Kamera</h3>
                                <p class="mt-1 text-lg text-white/90 sm:text-2xl">Mulai dari Rp129rb/hari</p>
                                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:gap-3">
                                    <a href="#"
                                        class="rounded-md bg-emerald-700 px-6 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-emerald-600">
                                        Order Now
                                    </a>
                                    <a href="#"
                                        class="rounded-md bg-white px-6 py-2.5 text-center text-sm font-semibold text-gray-800 transition hover:bg-gray-100">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="group relative min-w-[96%] snap-start overflow-hidden rounded-2xl border border-emerald-100 shadow-lg sm:min-w-[90%] lg:min-w-[86%]">
                        <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Perlengkapan"
                            class="h-[380px] w-full object-cover sm:h-[450px] lg:h-[500px]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/35 to-black/10"></div>
                        <div class="absolute inset-0 flex flex-col justify-between p-5 text-white sm:p-7">
                            <p class="text-sm font-semibold text-white/90 sm:text-base">Kategori</p>
                            <div>
                                <h3 class="text-4xl font-bold leading-tight sm:text-5xl">Perlengkapan</h3>
                                <p class="mt-1 text-lg text-white/90 sm:text-2xl">Mulai dari Rp79rb/hari</p>
                                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:gap-3">
                                    <a href="#"
                                        class="rounded-md bg-emerald-700 px-6 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-emerald-600">
                                        Order Now
                                    </a>
                                    <a href="#"
                                        class="rounded-md bg-white px-6 py-2.5 text-center text-sm font-semibold text-gray-800 transition hover:bg-gray-100">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <button type="button" id="section2Next"
                    class="absolute right-2 top-1/2 z-10 hidden -translate-y-1/2 rounded-lg border border-emerald-200 bg-transparent p-2.5 text-emerald-700 shadow-md transition hover:bg-emerald-600 lg:block"
                    aria-label="Slide berikutnya">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="white">
                        <path d="M10 6l6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="w-full bg-white px-4 py-10 sm:py-12" id="section-3">
        <div class="mx-auto w-full max-w-7xl">
            <div class="mb-8 text-center sm:mb-10">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700/80">Cara Rental</p>
                <h2 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">Langkah-Langkah Perentalan</h2>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600 sm:text-base">
                    Proses sewa dibuat sederhana agar kamu bisa fokus ke perjalanan tanpa ribet urusan teknis.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-2xl border border-emerald-100 bg-emerald-50/40 p-5 shadow-sm">
                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 7h16M7 4v6m10-6v6M5 11h14v8H5z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900">Pilih Alat</h3>
                    <p class="mt-2 text-sm leading-relaxed text-justify text-gray-600">
                        Jelajahi katalog lalu pilih alat camping, kamera, atau perlengkapan yang paling sesuai kebutuhan perjalananmu.
                    </p>
                </article>

                <article class="rounded-2xl border border-emerald-100 bg-emerald-50/40 p-5 shadow-sm">
                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M8 2v4m8-4v4M4 8h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900">Atur Tanggal</h3>
                    <p class="mt-2 text-sm leading-relaxed text-justify text-gray-600">
                        Tentukan tanggal mulai sampai selesai penyewaan, lalu cek ketersediaan agar rencana perjalanan tetap aman.
                    </p>
                </article>

                <article class="rounded-2xl border border-emerald-100 bg-emerald-50/40 p-5 shadow-sm">
                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 7h16M6 7l1 13h10l1-13M9 10v6m6-6v6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900">Lakukan Pembayaran</h3>
                    <p class="mt-2 text-sm leading-relaxed text-justify text-gray-600">
                        Selesaikan pembayaran melalui metode yang tersedia untuk mengamankan pesananmu secara instan.
                    </p>
                </article>

                <article class="rounded-2xl border border-emerald-100 bg-emerald-50/40 p-5 shadow-sm">
                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 7h13l3 3v7H3V7zm13 0v3h3M8 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900">Ambil Barang</h3>
                    <p class="mt-2 text-sm leading-relaxed text-justify text-gray-600">
                        Ambil alat di toko sesuai jadwal, kemudian nikmati perjalananmu dengan perlengkapan yang sudah siap pakai.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="w-full bg-gradient-to-b from-white via-emerald-50/40 to-emerald-50/40 px-4 py-10 sm:py-12" id="section-4">
        <div class="mx-auto w-full max-w-6xl">
            <div class="mb-7 text-center sm:mb-8">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700/80">Keunggulan Kami</p>
                <h2 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">Mengapa Pilih Kami?</h2>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600 sm:text-base">
                    OutRent hadir untuk memastikan pengalaman sewa alat outdoor dan kamera jadi lebih aman, cepat, dan nyaman.
                </p>
            </div>

            <div class="overflow-hidden rounded-2xl border border-emerald-100 bg-white shadow-md">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-5 sm:p-6 lg:p-7">
                        <div class="space-y-3.5">
                            <article class="rounded-xl border border-emerald-100/80 bg-emerald-50/40 p-3.5">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="m5 12 4 4L19 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">Alat Selalu Prima</h3>
                                        <p class="mt-1 text-sm leading-relaxed text-gray-600">
                                    Seluruh perlengkapan outdoor dan kamera melewati pengecekan rutin serta perawatan berkala sebelum disewakan.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="rounded-xl border border-emerald-100/80 bg-emerald-50/40 p-3.5">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="M12 3v18M7.5 7.5h7a2.5 2.5 0 1 1 0 5h-5a2.5 2.5 0 1 0 0 5h7" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">Harga Transparan</h3>
                                        <p class="mt-1 text-sm leading-relaxed text-gray-600">
                                    Tidak ada biaya tersembunyi. Harga yang kamu lihat di katalog adalah harga final yang jelas sejak awal.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="rounded-xl border border-emerald-100/80 bg-emerald-50/40 p-3.5">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <circle cx="12" cy="12" r="8" stroke-width="1.8" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">Proses Cepat & Mudah</h3>
                                        <p class="mt-1 text-sm leading-relaxed text-gray-600">
                                    Pemesanan dibuat simpel: pilih alat, atur jadwal, lakukan pembayaran, lalu barang siap diambil.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="rounded-xl border border-emerald-100/80 bg-emerald-50/40 p-3.5">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="M4 12a8 8 0 0 1 16 0M6 12v4a2 2 0 0 0 2 2h1v-6H8a2 2 0 0 0-2 2Zm12 0v6h-1v-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">Dukungan 24/7</h3>
                                        <p class="mt-1 text-sm leading-relaxed text-gray-600">
                                    Tim kami siap membantu jika kamu mengalami kendala teknis selama masa penyewaan.
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="relative min-h-[240px] sm:min-h-[280px] lg:min-h-[360px]">
                        <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Keunggulan OutRent"
                            class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/15 to-transparent"></div>
                        <div class="pointer-events-none absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full border border-white/50 bg-white/25 text-white backdrop-blur-sm sm:right-5 sm:top-5">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 3l2.8 5.7L21 9.6l-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9L12 3z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="pointer-events-none absolute bottom-4 left-4 flex h-9 w-9 items-center justify-center rounded-full border border-white/50 bg-white/25 text-white backdrop-blur-sm sm:bottom-5 sm:left-5">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-gradient-to-b from-emerald-50/40 via-white to-white px-4 py-10 sm:py-12" id="section-5">
        <div class="mx-auto w-full max-w-6xl">
            <div class="mb-7 text-center sm:mb-8">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700/80">Ulasan Pelanggan</p>
                <h2 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">Yang Mereka Katakan</h2>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600 sm:text-base">
                    Pengalaman asli dari pelanggan yang sudah menggunakan layanan sewa OutRent.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="8" r="3.2" stroke-width="1.8" />
                                <path d="M5.5 19a6.5 6.5 0 0 1 13 0" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Hikaru Nakamura</h3>
                            <div class="mt-1 flex items-center gap-0.5 text-amber-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-justify text-gray-600">
                        Adminnya ramah dan alat yang datang bersih. Saya booking H-1 dan prosesnya cepat sekali. Cocok untuk perjalanan dadakan.
                    </p>
                </article>

                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="8" r="3.2" stroke-width="1.8" />
                                <path d="M5.5 19a6.5 6.5 0 0 1 13 0" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Magnus Carlsen</h3>
                            <div class="mt-1 flex items-center gap-0.5 text-amber-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-justify text-gray-600">
                        Sewa mirrorless untuk tugas kampus hasilnya memuaskan. Kondisi kamera bagus, baterai aman, dan harga masih masuk budget pelajar.
                    </p>
                </article>

                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm sm:col-span-2 lg:col-span-1">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="8" r="3.2" stroke-width="1.8" />
                                <path d="M5.5 19a6.5 6.5 0 0 1 13 0" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Gukesh</h3>
                            <div class="mt-1 flex items-center gap-0.5 text-amber-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-justify text-gray-600">
                        Tendanya bersih, mudah dipasang, dan perlengkapan lengkap. Sangat membantu untuk pemula yang baru mulai camping.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <footer id="section-6" class="w-full bg-gradient-to-b from-white to-emerald-50/60 pt-16 border-t border-emerald-50">
        <div class="mx-auto w-full max-w-7xl px-4">
            <!-- Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Col 1: Logo & Maps -->
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-gray-900"><span class="text-emerald-600">Out</span>Rent</h2>
                    <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consectetur adipiscing elit quisque faucibus ex.
                    </p>
                </div>

                <!-- Col 2: Produk -->
                <div>
                    <h3 class="text-base font-bold text-gray-900 mb-4">Produk</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Kamera</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Lensa</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Aksesoris Kamera</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Lightning & Audio</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Tenda</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Peralatan Memasak</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Peralatan Tidur</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Penerangan & Power</a></li>
                    </ul>
                </div>

                <!-- Col 3: Informasi -->
                <div>
                    <h3 class="text-base font-bold text-gray-900 mb-4">Informasi</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Blog & Tips</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- Col 4: Bantuan -->
                <div>
                    <h3 class="text-base font-bold text-gray-900 mb-4">Bantuan</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Cara Pemesanan</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Hubungi Layanan Pelanggan</a></li>
                        <li><a href="#" class="hover:text-emerald-700 transition-colors underline decoration-emerald-200 underline-offset-4">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="bg-emerald-700 py-4 text-center text-sm text-emerald-50 font-medium w-full">
            Copyright &copy; 2025 Outrent. All Rights Reserved
        </div>
    </footer>

    <!-- Small Sticky Footer -->
    <div id="small-footer" class="fixed bottom-0 left-0 w-full bg-white border-t border-emerald-100 py-3 text-sm z-40 transition-transform duration-500 translate-y-0 shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-between items-center px-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <span class="font-bold text-gray-900"><span class="text-emerald-600">Out</span>Rent</span>
                <span class="hidden sm:inline text-gray-400">|</span>
                <span class="hidden sm:inline text-gray-600">Sewa Alat Camping & Kamera</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-500 hidden md:inline">Copyright &copy; 2025</span>
                <button onclick="window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'})" class="text-xs bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full transition-all shadow-sm shadow-emerald-600/30 flex items-center gap-1.5 font-medium">
                    Lihat Footer
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Footer Reveal Logic
            const mainFooter = document.getElementById('section-6');
            const smallFooter = document.getElementById('small-footer');
            
            if (mainFooter && smallFooter) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            smallFooter.classList.add('translate-y-full', 'opacity-0');
                        } else {
                            smallFooter.classList.remove('translate-y-full', 'opacity-0');
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.05
                });
                
                observer.observe(mainFooter);
            }


            const track = document.getElementById('section2Track');
            const prev = document.getElementById('section2Prev');
            const next = document.getElementById('section2Next');

            if (!track || !prev || !next) return;

            const slideAmount = () => Math.round(track.clientWidth * 0.9);

            prev.addEventListener('click', function() {
                track.scrollBy({ left: -slideAmount(), behavior: 'smooth' });
            });

            next.addEventListener('click', function() {
                track.scrollBy({ left: slideAmount(), behavior: 'smooth' });
            });
        });
    </script>
 
</x-app2-layout>