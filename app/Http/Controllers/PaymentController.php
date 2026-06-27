<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        // 1. Buat data transaksi (Contoh simulasi dari aplikasi OutRent)
        $params = [
            'transaction_details' => [
                'order_id' => 'OUTRENT-' . uniqid(), // Harus unik setiap transaksi
                'gross_amount' => 150000, // Total harga (Rp 150.000)
            ],
            'customer_details' => [
                'first_name' => 'Agung',
                'email' => 'customer@example.com',
                'phone' => '081234567890',
            ],
            // Pilihan item yang disewa (opsional)
            'item_details' => [
                [
                    'id' => 'ITEM-01',
                    'price' => 150000,
                    'quantity' => 1,
                    'name' => 'Sewa Alat Camping Paket A'
                ]
            ]
        ];

        try {
            // 2. Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            // 3. Kirim token ke view untuk diproses di frontend
            return view('checkout', compact('snapToken'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
}
