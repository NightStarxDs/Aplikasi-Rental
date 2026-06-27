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
        $userTerlambat = data_get($stats ?? [], 'user_terlambat', []);
        $labelPendapatan = data_get($stats ?? [], 'label_pendapatan', 'Pendapatan Bulan Ini');
        $barangPerSubkategori = data_get($stats ?? [], 'barang_per_subkategori', []);
    @endphp

    <div class="mt-6 pb-3 px-6">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-gray-800">Filter Dashboard & Export Laporan</h2>
            </div>
            
            <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
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
                        <button type="submit" class="mr-2 inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Filter</button>
                        <button type="submit" formmethod="POST" formaction="{{ route('admin.export.cashflow') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
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
                            <p class="text-sm font-medium text-gray-500">{{ $labelPendapatan }}</p>
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
                            <p class="text-sm font-medium text-gray-500">Pendapatan Denda</p>
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
                            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ count($userTerlambat) }}</p>
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

                    <div class="space-y-3">
                        @foreach ($barangPerKategori as $kategori => $jumlah)
                            @php
                                $safeTotal = max((int) $totalBarang, 1);
                                $persentase = min(100, round(((int) $jumlah / $safeTotal) * 100));
                            @endphp
                            <div x-data="{ open: false }" class="border border-gray-100 rounded-lg overflow-hidden">
                                <button @click="open = !open" type="button" class="w-full flex items-center justify-between bg-gray-50/50 p-3 hover:bg-gray-100 transition focus:outline-none">
                                    <div class="flex-1 text-left">
                                        <div class="mb-1 flex items-center justify-between text-sm">
                                            <div class="flex items-center gap-2">
                                                <svg class="h-3 w-3 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                                <p class="font-medium text-gray-700">{{ $kategori }}</p>
                                            </div>
                                            <p class="font-semibold text-gray-800">{{ number_format($jumlah) }}</p>
                                        </div>
                                        <div class="h-1.5 rounded-full bg-gray-200 w-full overflow-hidden ml-5" style="width: calc(100% - 1.25rem);">
                                            <div class="h-1.5 rounded-full bg-emerald-500 transition-all duration-300" style="width: {{ $persentase }}%"></div>
                                        </div>
                                    </div>
                                </button>
                                
                                <div x-show="open" x-collapse x-cloak class="bg-white border-t border-gray-100 px-3 py-2 space-y-1">
                                    @if(isset($barangPerSubkategori[$kategori]))
                                        @foreach($barangPerSubkategori[$kategori] as $subkategori => $subJumlah)
                                            <div class="flex items-center justify-between text-xs text-gray-600 pl-5 py-1.5 border-b border-gray-50 last:border-0 hover:bg-gray-50 rounded transition">
                                                <span>{{ $subkategori }}</span>
                                                <span class="font-semibold bg-gray-100 px-2 py-0.5 rounded-md text-gray-700">{{ number_format($subJumlah) }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-gray-400 pl-5 py-1">Tidak ada subkategori.</p>
                                    @endif
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

        <!-- Daftar User Terlambat -->
        <div class="mt-6 pb-8">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-red-600 flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Daftar Penyewa Terlambat
                </h2>
                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700">
                    {{ count($userTerlambat) }} Transaksi
                </span>
            </div>
            
            <article class="rounded-xl border border-red-200 bg-white shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-red-50 text-xs uppercase text-red-700 border-b border-red-100">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold">Kode Rental</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Penyewa</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Tgl Kembali (Harusnya)</th>
                                <th scope="col" class="px-4 py-3 font-semibold">Keterlambatan</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($userTerlambat as $rental)
                                @php
                                    $waktuKembali = \Carbon\Carbon::parse($rental->waktu_kembali);
                                    $terlambat = $waktuKembali->diffForHumans(now(), ['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]);
                                @endphp
                                <tr class="hover:bg-red-50/50 transition-colors">
                                    <td class="px-4 py-3 font-mono font-medium text-gray-900">{{ $rental->kode_rental }}</td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $rental->user->name ?? 'Guest' }}</td>
                                    <td class="px-4 py-3">{{ $waktuKembali->format('d M Y, H:i') }}</td>
                                    <td class="px-4 py-3 text-red-600 font-medium font-mono">{{ $terlambat }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('Transaksi') }}" class="inline-flex items-center gap-1 rounded bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-700 transition">
                                            Kelola
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="rounded-full bg-emerald-50 p-3 mb-2">
                                                <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <p class="font-medium text-gray-700">Tidak ada penyewa yang terlambat.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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