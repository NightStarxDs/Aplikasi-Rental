<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rental;
use App\Models\Detail_Rental;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;

class Checkout extends Component
{
    use WithFileUploads;

    public $checkoutData = [];
    public $paymentMethod = 'COD';
    public $isLoading = false;
    public $showDataIncompleteModal = false;
    public $snapToken;

    public function mount()
    {
        $this->checkoutData = session()->get('checkout_data', []);

        if (empty($this->checkoutData)) {
            return redirect()->route('Keranjang');
        }
    }

    public function processCheckout()
    {
        // Cek kelengkapan data user
        $user = Auth::user();
        if (empty($user->telepon) || empty($user->alamat)) {
            $this->showDataIncompleteModal = true;
            return;
        }

        // Validation for payment method
        if (!in_array($this->paymentMethod, ['COD', 'Midtrans'])) {
            $this->paymentMethod = 'COD';
        }

        $this->isLoading = true;

        DB::beginTransaction();
        try {
            $statusRental = $this->paymentMethod === 'Midtrans' ? 'Menunggu Pembayaran' : 'Diajukan';

            $rental = Rental::create([
                'id_user' => Auth::id(), 
                'waktu_sewa' => $this->checkoutData['waktu_sewa'],
                'waktu_kembali' => $this->checkoutData['waktu_kembali'],
                'waktu_kembali_aktual' => $this->checkoutData['waktu_kembali'],
                'total_harga' => $this->checkoutData['total_harga'],
                'total_denda' => 0.0,
                'status_rental' => $statusRental,
                'metode_pembayaran' => $this->paymentMethod,
                'bukti_pembayaran' => null,
            ]);

            foreach ($this->checkoutData['items'] as $kodeBarang => $item) {
                $hargaSatuan = $this->checkoutData['kategori'] === 'jam' ? $item['harga_perjam'] : $item['harga_perhari'];
                $subtotalItem = $hargaSatuan * $item['qty'] * $this->checkoutData['durasi'];

                // Validasi stok sebelum proses
                $barangModel = \App\Models\Barang::find($kodeBarang);
                if (!$barangModel || $barangModel->stok < $item['qty']) {
                    DB::rollBack();
                    $namaBarang = $barangModel->nama_barang ?? 'Barang';
                    session()->flash('error', "Stok {$namaBarang} tidak mencukupi. Stok tersisa: " . ($barangModel->stok ?? 0));
                    $this->isLoading = false;
                    return;
                }

                Detail_Rental::create([
                    'kode_rental'         => $rental->kode_rental,
                    'kode_barang'         => $kodeBarang,
                    'jumlah_barang'       => $item['qty'],
                    'catatan_kondisi'     => 'Baik',
                    'denda_keterlambatan' => 0.0,
                    'denda_kerusakan'     => 0.0,
                    'subtotal'            => $subtotalItem,
                    'status_detail'       => 'Menunggu',
                ]);
                
                // Kurangi stok & sinkronkan status otomatis HANYA JIKA COD (Midtrans akan dikurangi saat success)
                if ($this->paymentMethod === 'COD') {
                    
                    // Hapus barang yang berhasil dicheckout dari keranjang (session)
                    $cart = session()->get('cart', []);
                    if(isset($cart[$kodeBarang])) {
                        unset($cart[$kodeBarang]);
                    }
                    session()->put('cart', $cart);
                }
            }

            if ($this->paymentMethod === 'COD') {
                session()->forget('checkout_data');
            }

            DB::commit();

            if ($this->paymentMethod === 'Midtrans') {
                // Set Konfigurasi Midtrans
                Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
                Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
                Config::$is3ds = env('MIDTRANS_IS_3DS', true);

                $params = [
                    'transaction_details' => [
                        'order_id' => $rental->kode_rental,
                        'gross_amount' => (int) $this->checkoutData['total_harga'],
                    ],
                    'customer_details' => [
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => Auth::user()->telepon ?? Auth::user()->phone,
                    ],
                ];

                $this->snapToken = Snap::getSnapToken($params);
                $this->dispatch('snap-pay', token: $this->snapToken, order_id: $rental->kode_rental);
                return;
            }

            return redirect()->route('checkout.success', ['kode_rental' => $rental->kode_rental]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
            $this->isLoading = false;
        }
    }

    #[Livewire\Attributes\On('payment-success')]
    public function handlePaymentSuccess($orderId)
    {
        $rental = Rental::with('detailRentals')->find($orderId);
        if ($rental && $rental->status_rental === 'Menunggu Pembayaran') {
            $rental->status_rental = 'Diajukan';
            $rental->save();
            
            foreach($rental->detailRentals as $detail) {
                $barangModel = \App\Models\Barang::find($detail->kode_barang);
                if ($barangModel) {
                    $barangModel->stok -= $detail->jumlah_barang;
                    $barangModel->syncStatus();
                }
                
                $cart = session()->get('cart', []);
                if(isset($cart[$detail->kode_barang])) {
                    unset($cart[$detail->kode_barang]);
                }
                session()->put('cart', $cart);
            }
            session()->forget('checkout_data');
        }
        
        return redirect()->route('checkout.success', ['kode_rental' => $orderId]);
    }

    #[Livewire\Attributes\On('payment-cancelled')]
    public function handlePaymentCancelled($orderId)
    {
        $rental = Rental::find($orderId);
        if ($rental && $rental->status_rental === 'Menunggu Pembayaran') {
            $rental->detailRentals()->delete();
            $rental->delete();
        }
        
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
