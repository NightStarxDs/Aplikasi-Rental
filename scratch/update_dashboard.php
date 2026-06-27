<?php

$file_path = 'c:\\laragon\\www\\Aplikasi-Rental\\resources\\views\\admin\\dashboard.blade.php';
$content = file_get_contents($file_path);

// 1. Update userTerlambat default to [] and add label_pendapatan
$content = str_replace(
    "\$userTerlambat = data_get(\$stats ?? [], 'user_terlambat', 0);",
    "\$userTerlambat = data_get(\$stats ?? [], 'user_terlambat', []);\n        \$labelPendapatan = data_get(\$stats ?? [], 'label_pendapatan', 'Pendapatan Bulan Ini');\n        \$barangPerSubkategori = data_get(\$stats ?? [], 'barang_per_subkategori', []);",
    $content
);

// 2. Extract the form and move it to the top
$form_start_marker = '<div class="mt-6">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-gray-800">Export Laporan Penjualan (Cashflow)</h2>';
$form_start = strpos($content, $form_start_marker);

$form_end_marker = '</article>
        </div>
    </div>

    <script>';
$form_end = strpos($content, $form_end_marker);

if ($form_start !== false && $form_end !== false) {
    $form_html = substr($content, $form_start, $form_end - $form_start + strlen('</article>
        </div>'));
    
    // Modify the form
    $form_html = str_replace('Export Laporan Penjualan (Cashflow)', 'Filter Dashboard & Export Laporan', $form_html);
    $form_html = str_replace('action="{{ route(\'admin.export.cashflow\') }}" method="POST"', 'action="{{ route(\'admin.dashboard\') }}" method="GET"', $form_html);
    
    // Add the Filter button
    $btn_export = '<button type="submit" formmethod="POST" formaction="{{ route(\'admin.export.cashflow\') }}"';
    $form_html = str_replace('<button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-emerald-600', 
        '<button type="submit" class="mr-2 inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Filter</button>
                        ' . $btn_export . ' class="inline-flex items-center justify-center rounded-md border border-transparent bg-emerald-600', 
        $form_html);
    
    // Remove old form
    $content = substr_replace($content, '', $form_start, strlen($form_html));
    
    // Inject form at the top (before Statistik Utama)
    $header_target = '<div class="px-6 py-6">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">';
    $content = str_replace($header_target, $form_html . "\n\n" . $header_target, $content);
}

// 3. Update Pendapatan Bulan Ini label
$content = str_replace('<p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>', '<p class="text-sm font-medium text-gray-500">{{ $labelPendapatan }}</p>', $content);

// 4. Update Pendapatan Tahun Ini to Pendapatan Denda
$content = str_replace('<p class="text-sm font-medium text-gray-500">Pendapatan Tahun Ini</p>', '<p class="text-sm font-medium text-gray-500">Pendapatan Denda</p>', $content);

// 5. Fix userTerlambat count in the card
$content = str_replace('{{ number_format($userTerlambat) }}', '{{ count($userTerlambat) }}', $content);

// 6. Add Subcategories and User Terlambat List at the bottom
$subcat_and_late_users = <<<EOT
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Kategori & Subkategori</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach (\$barangPerSubkategori as \$kategori => \$subkategoris)
                    <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-3 border-b pb-2">{{ \$kategori }}</h3>
                        <ul class="space-y-2">
                            @foreach (\$subkategoris as \$sub => \$jumlah)
                                <li class="flex justify-between text-sm text-gray-600">
                                    <span>{{ \$sub }}</span>
                                    <span class="font-medium bg-gray-100 px-2 py-0.5 rounded">{{ \$jumlah }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold text-red-700 mb-4 flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Daftar User Terlambat
            </h2>
            <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">User</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Kontak</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Waktu Kembali Seharusnya</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Keterlambatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse(\$userTerlambat as \$rental)
                            @php
                                \$diff = \Carbon\Carbon::parse(\$rental->waktu_kembali)->diffForHumans(null, true);
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ \$rental->user->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ \$rental->user->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse(\$rental->waktu_kembali)->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3 text-red-600 font-semibold">{{ \$diff }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">Tidak ada user yang terlambat saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
EOT;

$content = str_replace('    <script>', $subcat_and_late_users . "\n    <script>", $content);

file_put_contents($file_path, $content);
echo "Dashboard view updated successfully.";
