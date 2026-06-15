<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail_Rental;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('Admin.Admin_Transaksi');
    }

    public function editTransaksi()
    {
        return view('Admin.Admin_Edit_Transaksi');
    }

    public function hapusTransaksi()
    {
        return view('Admin.Admin_Transaksi');
    }

    public function pengambilanPengembalian($kode_rental)
    {
        $rental = Rental::with(['user', 'detailRentals.barang'])
            ->findOrFail($kode_rental);

        // Hitung denda keterlambatan per-detail (tidak disimpan) berdasarkan waktu_kembali_aktual jika ada
        $actualReturn = $rental->waktu_kembali_aktual ?? $rental->waktu_kembali ?? null;

        $subtotal = $rental->detailRentals->sum(fn ($detail) => $detail->subtotal ?? 0);
        foreach ($rental->detailRentals as $detail) {
            $detail->calculated_denda_keterlambatan = 0;
            if ($actualReturn) {
                $detail->calculated_denda_keterlambatan = $detail->hitungDendaKeterlambatan($actualReturn);
            }
        }

        $dendaKeterlambatan = $rental->detailRentals->sum(fn ($detail) => ($detail->denda_keterlambatan ?? 0) > 0 ? $detail->denda_keterlambatan : ($detail->calculated_denda_keterlambatan ?? 0));
        $dendaKerusakan = $rental->detailRentals->sum(fn ($detail) => $detail->denda_kerusakan ?? 0);
        $checkoutPaid = (int) round($rental->total_harga ?? $subtotal);
        $totalDenda = (int) round($dendaKeterlambatan + $dendaKerusakan);
        $grandTotal = $checkoutPaid + $totalDenda;

        return view('Admin.Admin_Pengambilan_dan_Pengembalian', compact(
            'rental',
            'subtotal',
            'dendaKeterlambatan',
            'dendaKerusakan',
            'checkoutPaid',
            'totalDenda',
            'grandTotal'
        ));
    }

    public function Transaksi_Penyewaan(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Rental::with('user');

        if ($status) {
            $query->where('status_rental', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_rental', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                });
            });
        }

        $rentals = $query->orderBy('kode_rental', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('Admin.Admin_Transaksi_Penyewaan', compact('rentals'));
    }

    public function updatePengembalian(Request $request, $kode_rental)
    {
        $rental = Rental::with(['detailRentals.barang'])->findOrFail($kode_rental);
        $action = $request->input('action');

        if ($action === 'batalkan') {
            DB::beginTransaction();
            try {
                $rental->status_rental = 'Dibatalkan';
                $rental->notifikasi_pembatalan = true;
                $rental->save();

                // Kembalikan stok barang
                foreach ($rental->detailRentals as $detail) {
                    $barang = $detail->barang;
                    if ($barang) {
                        $barang->stok += $detail->jumlah_barang;
                        $barang->save();
                    }
                }

                // Simpan notifikasi pembatalan ke session untuk ditampilkan saat user login
                session()->flash('cancellation_notification', [
                    'kode_rental' => $rental->kode_rental,
                    'tanggal_pembatalan' => now()->format('d M Y H:i'),
                    'user_id' => $rental->id_user
                ]);

                DB::commit();

                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('success', 'Transaksi berhasil dibatalkan. Pelanggan akan menerima notifikasi saat login.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
            }
        }

        if ($action === 'ambil') {
            $rental->status_rental = 'Disewa';
            $rental->waktu_sewa = $rental->waktu_sewa ?? now();
            $rental->save();

            return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                ->with('success', 'Transaksi berhasil diperbarui menjadi Disewa.');
        }

        if ($action === 'kembali') {
            DB::beginTransaction();
            try {
                // Langkah 1: catat waktu kembali aktual dan ubah status utama menjadi Dikembalikan.
                $rental->waktu_kembali_aktual = now();
                $rental->status_rental = 'Dikembalikan';

                foreach ($rental->detailRentals as $detail) {
                    $detailId = $detail->kode_detail;
                    $detail->catatan_kondisi = $request->input("catatan_kondisi.$detailId") ?: $detail->catatan_kondisi;
                    $detail->denda_kerusakan = $request->input("denda_kerusakan.$detailId", 0);
                    $detail->save();

                    // Kembalikan stok barang sesuai jumlah yang dipinjam
                    $barang = $detail->barang;
                    if ($barang) {
                        $barang->stok += $detail->jumlah_barang;
                        $barang->status_barang = $barang->stok > 0 ? 'Tersedia' : 'Tidak Tersedia';
                        $barang->save();
                    }
                }

                $rental->save();
                DB::commit();

                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('success', 'Pengembalian dicatat dan stok barang telah dikembalikan. Silakan selesaikan transaksi untuk mengubah status menjadi Selesai.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('error', 'Gagal mencatat pengembalian: ' . $e->getMessage());
            }
        }

        if ($action === 'selesai') {
            DB::beginTransaction();
            try {
                // Langkah 2: finalisasi, hitung denda keterlambatan otomatis dan simpan denda kerusakan dari input
                if (! $rental->waktu_kembali_aktual) {
                    // Jika belum pernah dicatat (langsung selesai tanpa 'kembali'), kembalikan stok sekarang
                    $rental->waktu_kembali_aktual = now();
                    $stokBelumDikembalikan = true;
                } else {
                    $stokBelumDikembalikan = false;
                }

                $totalDenda = 0;
                foreach ($rental->detailRentals as $detail) {
                    $detailId = $detail->kode_detail;
                    $detail->catatan_kondisi = $request->input("catatan_kondisi.$detailId") ?: $detail->catatan_kondisi;
                    $detail->denda_kerusakan = $request->input("denda_kerusakan.$detailId", 0);
                    // Hitung keterlambatan otomatis berdasarkan waktu_kembali_aktual
                    $detail->denda_keterlambatan = $detail->hitungDendaKeterlambatan($rental->waktu_kembali_aktual);
                    $detail->status_detail = 'Lunas';
                    $detail->save();

                    $totalDenda += floatval($detail->denda_kerusakan ?? 0) + floatval($detail->denda_keterlambatan ?? 0);

                    // Kembalikan stok hanya jika belum dikembalikan saat step 'kembali'
                    if ($stokBelumDikembalikan) {
                        $barang = $detail->barang;
                        if ($barang) {
                            $barang->stok += $detail->jumlah_barang;
                            $barang->status_barang = $barang->stok > 0 ? 'Tersedia' : 'Tidak Tersedia';
                            $barang->save();
                        }
                    }
                }

                $rental->status_rental = 'Selesai';
                $rental->total_denda = $totalDenda;
                $rental->save();

                DB::commit();

                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('success', 'Transaksi berhasil diselesaikan dan biaya telah diperbarui.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
                    ->with('error', 'Gagal menyelesaikan transaksi: ' . $e->getMessage());
            }
        }

        return redirect()->route('Pengambilan_dan_Pengembalian', ['kode_rental' => $rental->kode_rental])
            ->with('error', 'Aksi tidak dikenali.');
    }
}
