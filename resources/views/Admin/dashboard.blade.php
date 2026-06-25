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
        $pendapatanBulanIni = data_get($stats ?? [], 'pendapatan_bulan_ini', 0);
        $pendapatanTahunIni = data_get($stats ?? [], 'pendapatan_tahun_ini', 0);
        $userTerlambat = data_get($stats ?? [], 'user_terlambat', 0);
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
                <h2 class="text-lg font-semibold text-gray-800">Keuangan & Kepatuhan</h2>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-800">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-lg bg-indigo-50 p-2 text-indigo-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                    </div>
                </article>

                <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-teal-200 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pendapatan Tahun Ini</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-800">Rp {{ number_format($pendapatanTahunIni, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-lg bg-teal-50 p-2 text-teal-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M3 3v18h18"/>
                                <path d="m19 9-5 5-4-4-3 3"/>
                            </svg>
                        </div>
                    </div>
                </article>

                <article class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-red-200 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">User Terlambat (Saat ini)</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ number_format($userTerlambat) }}</p>
                        </div>
                        <div class="rounded-lg bg-red-50 p-2 text-red-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                    </div>
                </article>
            </div>
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
        <div class="mt-6">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-gray-800">Export Laporan Penjualan (Cashflow)</h2>
            </div>
            
            <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <form action="{{ route('admin.export.cashflow') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <label for="jenis_rentang" class="mb-1 block text-sm font-medium text-gray-700">Rentang Waktu</label>
                            <select name="jenis_rentang" id="jenis_rentang" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                <option value="bulan">Per Bulan</option>
                                <option value="minggu">Per Minggu (Bulan Berjalan)</option>
                                <option value="tahun">Per Tahun</option>
                                <option value="custom">Rentang Khusus</option>
                            </select>
                        </div>
                        
                        <div id="filter-bulan" class="filter-group block">
                            <label for="bulan" class="mb-1 block text-sm font-medium text-gray-700">Bulan</label>
                            <select name="bulan" id="bulan" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div id="filter-tahun" class="filter-group block">
                            <label for="tahun" class="mb-1 block text-sm font-medium text-gray-700">Tahun</label>
                            <select name="tahun" id="tahun" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                @for($i = now()->year; $i >= now()->year - 5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div id="filter-custom-start" class="filter-group hidden">
                            <label for="start_date" class="mb-1 block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                        </div>

                        <div id="filter-custom-end" class="filter-group hidden">
                            <label for="end_date" class="mb-1 block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                        </div>
                    </div>
                    
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            Export ke CSV
                        </button>
                    </div>
                </form>
            </article>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisRentang = document.getElementById('jenis_rentang');
            const filterBulan = document.getElementById('filter-bulan');
            const filterTahun = document.getElementById('filter-tahun');
            const filterCustomStart = document.getElementById('filter-custom-start');
            const filterCustomEnd = document.getElementById('filter-custom-end');

            function updateFilters() {
                const val = jenisRentang.value;
                // Sembunyikan semua dulu
                filterBulan.classList.add('hidden');
                filterTahun.classList.add('hidden');
                filterCustomStart.classList.add('hidden');
                filterCustomEnd.classList.add('hidden');

                if (val === 'bulan' || val === 'minggu') {
                    filterBulan.classList.remove('hidden');
                    filterTahun.classList.remove('hidden');
                } else if (val === 'tahun') {
                    filterTahun.classList.remove('hidden');
                } else if (val === 'custom') {
                    filterCustomStart.classList.remove('hidden');
                    filterCustomEnd.classList.remove('hidden');
                }
            }

            jenisRentang.addEventListener('change', updateFilters);
        });
    </script>
</x-app-layout>