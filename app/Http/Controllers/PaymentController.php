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
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        // Validasi data yang dikirim dari frontend
        $validated = $request->validate([
            'kode_rental'  => 'required|string',
            'gross_amount' => 'required|numeric|min:1',
            'first_name'   => 'required|string|max:100',
            'email'        => 'required|email|max:100',
            'phone'        => 'required|string|max:20',
            'item_name'    => 'required|string|max:255',
        ]);

        // Buat data transaksi dari request (dinamis)
        $params = [
            'transaction_details' => [
                'order_id'     => 'OUTRENT-' . $validated['kode_rental'] . '-' . uniqid('', true), // Selalu unik
                'gross_amount' => (int) $validated['gross_amount'],
            ],
            'customer_details' => [
                'first_name' => $validated['first_name'],
                'email'      => $validated['email'],
                'phone'      => $validated['phone'],
            ],
            'item_details' => [
                [
                    'id'       => $validated['kode_rental'],
                    'price'    => (int) $validated['gross_amount'],
                    'quantity' => 1,
                    'name'     => $validated['item_name'],
                ]
            ],
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Kirim token ke view untuk diproses di frontend
            return view('checkout', compact('snapToken'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
