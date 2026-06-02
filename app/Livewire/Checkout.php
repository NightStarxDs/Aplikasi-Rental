<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rental;
use App\Models\Detail_Rental;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Checkout extends Component
{
    use WithFileUploads;

    public $checkoutData = [];
    public $paymentMethod = 'COD';
    public $buktiPembayaran;
    public $isLoading = false;

    public function mount()
    {
        $this->checkoutData = session()->get('checkout_data', []);

        if (empty($this->checkoutData)) {
            return redirect()->route('Keranjang');
        }
    }

    public function processCheckout()
    {
        // Validation
        if ($this->paymentMethod === 'QRIS' || $this->paymentMethod === 'Transfer Bank') {
            $this->validate([
                'buktiPembayaran' => 'required|image|max:2048', // 2MB Max
            ], [
                'buktiPembayaran.required' => 'Bukti pembayaran wajib diunggah untuk metode ini.',
                'buktiPembayaran.image' => 'Bukti pembayaran harus berupa gambar.',
                'buktiPembayaran.max' => 'Ukuran bukti pembayaran maksimal 2MB.',
            ]);
        }

        $this->isLoading = true;

        DB::beginTransaction();
        try {
            $buktiPath = null;
            if ($this->buktiPembayaran) {
                $buktiPath = $this->buktiPembayaran->store('bukti_pembayaran', 'public');
            }

            $rental = Rental::create([
                'id_user' => Auth::id(), 
                'waktu_sewa' => $this->checkoutData['waktu_sewa'],
                'waktu_kembali' => $this->checkoutData['waktu_kembali'],
                'waktu_kembali_aktual' => $this->checkoutData['waktu_kembali'],
                'total_harga' => $this->checkoutData['total_harga'],
                'total_denda' => 0.0,
                'status_rental' => 'Disewa', // default based on migration
                'metode_pembayaran' => $this->paymentMethod,
                'bukti_pembayaran' => $buktiPath,
            ]);

            foreach ($this->checkoutData['items'] as $kodeBarang => $item) {
                $hargaSatuan = $this->checkoutData['kategori'] === 'jam' ? $item['harga_perjam'] : $item['harga_perhari'];
                $subtotalItem = $hargaSatuan * $item['qty'] * $this->checkoutData['durasi'];

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
                
                // Hapus barang yang berhasil dicheckout dari keranjang (session)
                $cart = session()->get('cart', []);
                if(isset($cart[$kodeBarang])) {
                    unset($cart[$kodeBarang]);
                }
                session()->put('cart', $cart);
            }

            // Bersihkan checkout data
            session()->forget('checkout_data');

            DB::commit();

            return redirect()->route('checkout.success', ['kode_rental' => $rental->kode_rental]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
