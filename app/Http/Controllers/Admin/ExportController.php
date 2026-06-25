<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function exportCashflow(Request $request)
    {
        $jenisRentang = $request->input('jenis_rentang');
        
        $query = Rental::with('user')->where('status_rental', 'Selesai');

        $startDate = null;
        $endDate = null;

        switch ($jenisRentang) {
            case 'bulan':
                $bulan = $request->input('bulan');
                $tahun = $request->input('tahun');
                $query->whereMonth('waktu_kembali_aktual', $bulan)
                      ->whereYear('waktu_kembali_aktual', $tahun);
                break;
            case 'minggu':
                $bulan = $request->input('bulan');
                $tahun = $request->input('tahun');
                // Mengambil data minggu ini dalam bulan/tahun yang dipilih (asumsi: minggu saat ini)
                $query->whereMonth('waktu_kembali_aktual', $bulan)
                      ->whereYear('waktu_kembali_aktual', $tahun)
                      ->whereBetween('waktu_kembali_aktual', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'tahun':
                $tahun = $request->input('tahun');
                $query->whereYear('waktu_kembali_aktual', $tahun);
                break;
            case 'custom':
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
                $query->whereBetween('waktu_kembali_aktual', [$startDate, $endDate]);
                break;
        }

        $rentals = $query->orderBy('waktu_kembali_aktual', 'desc')->get();

        $filename = "rekap_penjualan_" . date('Ymd_His') . ".csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = [
            'Kode Rental', 
            'Nama Pelanggan', 
            'Waktu Sewa', 
            'Waktu Kembali', 
            'Waktu Kembali Aktual', 
            'Metode Pembayaran',
            'Status Rental',
            'Total Harga (Sewa)', 
            'Total Denda', 
            'Total Pendapatan'
        ];

        $callback = function() use($rentals, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $totalSemuaHarga = 0;
            $totalSemuaDenda = 0;
            $totalSemuaPendapatan = 0;

            foreach ($rentals as $rental) {
                $totalPendapatan = $rental->total_harga + $rental->total_denda;
                $row = [
                    $rental->kode_rental,
                    $rental->user ? $rental->user->name : 'Unknown',
                    $rental->waktu_sewa ? $rental->waktu_sewa->format('Y-m-d H:i') : '',
                    $rental->waktu_kembali ? $rental->waktu_kembali->format('Y-m-d H:i') : '',
                    $rental->waktu_kembali_aktual ? $rental->waktu_kembali_aktual->format('Y-m-d H:i') : '',
                    $rental->metode_pembayaran,
                    $rental->status_rental,
                    $rental->total_harga,
                    $rental->total_denda,
                    $totalPendapatan
                ];

                fputcsv($file, $row);

                $totalSemuaHarga += $rental->total_harga;
                $totalSemuaDenda += $rental->total_denda;
                $totalSemuaPendapatan += $totalPendapatan;
            }

            // Tambahkan baris total di akhir
            fputcsv($file, ['', '', '', '', '', '', 'TOTAL:', $totalSemuaHarga, $totalSemuaDenda, $totalSemuaPendapatan]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
