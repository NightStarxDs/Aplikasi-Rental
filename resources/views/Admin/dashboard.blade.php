<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard Admin</h1>
                <p class="mt-1 text-sm text-gray-500">Ringkasan statistik penyewaan dan inventaris hari ini</p>
            </div>
            <span class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                Statistik Real-time
            </span>
        </div>
    </x-slot>

    @php
        $totalBarang = data_get($stats ?? [], 'total_barang', 0);
        $penyewaAktif = data_get($stats ?? [], 'penyewa_aktif', 0);
        $barangDisewa = data_get($stats ?? [], 'barang_disewa', 0);
        $jumlahTransaksi = data_get($stats ?? [], 'jumlah_transaksi', 0);
        $barangPerKategori = data_get($stats ?? [], 'barang_per_kategori', [
            'Kamera' => 0,
            'Camping' => 0,
        ]);
    @endphp

    <div class="px-6 py-6">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-semibold text-gray-800">Statistik Utama</h2>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah Barang</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-800">{{ number_format($totalBarang) }}</p>
                    </div>
                    <div class="rounded-lg bg-emerald-50 p-2 text-emerald-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M3 7.5 12 3l9 4.5-9 4.5L3 7.5Z"/>
                            <path d="M3 12.5 12 17l9-4.5"/>
                            <path d="M3 17.5 12 22l9-4.5"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 h-1.5 rounded-full bg-gray-100">
                    <div class="h-1.5 w-4/5 rounded-full bg-emerald-500"></div>
                </div>
            </article>

            <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah User</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-800">{{ number_format($penyewaAktif) }}</p>
                    </div>
                    <div class="rounded-lg bg-blue-50 p-2 text-blue-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 h-1.5 rounded-full bg-gray-100">
                    <div class="h-1.5 w-3/5 rounded-full bg-blue-500"></div>
                </div>
            </article>

            <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Barang Sedang Disewa</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-800">{{ number_format($barangDisewa) }}</p>
                    </div>
                    <div class="rounded-lg bg-amber-50 p-2 text-amber-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="16" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 h-1.5 rounded-full bg-gray-100">
                    <div class="h-1.5 w-2/3 rounded-full bg-amber-500"></div>
                </div>
            </article>
        </div>

        <div class="mt-6">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-gray-800">Statistik Tambahan</h2>
            </div>

            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-2  hover:-translate-y-0.5 hover:border-gray-200 hover:shadow-md">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-700">Jumlah Barang per Kategori</h3>
                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                            {{ count($barangPerKategori) }} Kategori
                        </span>
                    </div>

                    <div class="space-y-3 ">
                        @foreach ($barangPerKategori as $kategori => $jumlah)
                            @php
                                $safeTotal = max((int) $totalBarang, 1);
                                $persentase = min(100, round(((int) $jumlah / $safeTotal) * 100));
                            @endphp
                            <div>
                                <div class="mb-1 flex items-center justify-between text-sm">
                                    <p class="font-medium text-gray-700">{{ $kategori }}</p>
                                    <p class="font-semibold text-gray-800">{{ number_format($jumlah) }}</p>
                                </div>
                                <div class="h-2 rounded-full bg-gray-100">
                                    <div class="h-2 rounded-full bg-emerald-500 transition-all duration-300" style="width: {{ $persentase }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </article>

                <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:-translate-y-0.5 hover:border-purple-200 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Transaksi</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-800">{{ number_format($jumlahTransaksi) }}</p>
                        </div>
                        <div class="rounded-lg bg-purple-50 p-2 text-purple-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="M7 8h10M7 12h10M7 16h6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 h-1.5 rounded-full bg-gray-100">
                        <div class="h-1.5 w-3/4 rounded-full bg-purple-500"></div>
                    </div>
                    <p class="mt-3 text-xs text-gray-500">Total seluruh transaksi tercatat pada sistem.</p>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>