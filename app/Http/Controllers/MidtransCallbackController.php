<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Detail_Rental;
use App\Models\Barang;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        $rental = Rental::where('kode_rental', $orderId)->first();

        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $rental->status_rental = 'Dibayar';
            }
        } else if ($transactionStatus == 'settlement') {
            $rental->status_rental = 'Dibayar';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $rental->status_rental = 'Dibatalkan';
            // Restore stock if it was deducted previously. Since the user said "make sure the logic isnt mess with the logic rn"
            // The previous logic deducted stock if not COD. We should return it if canceled.
            $details = Detail_Rental::where('kode_rental', $rental->kode_rental)->get();
            foreach($details as $detail) {
                $detail->status_detail = 'Dibatalkan';
                $detail->save();
                
                $barang = Barang::where('kode_barang', $detail->kode_barang)->first();
                if($barang) {
                    $barang->stok += $detail->jumlah_barang;
                    $barang->syncStatus();
                }
            }
        } else if ($transactionStatus == 'pending') {
            $rental->status_rental = 'Menunggu Pembayaran';
        }

        $rental->save();

        return response()->json(['message' => 'Payment status updated successfully']);
    }
}
