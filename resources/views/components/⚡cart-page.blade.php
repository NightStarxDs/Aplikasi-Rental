<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;

class CartPage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public $rent_type = 'perjam'; 
    public $waktu_sewa;
    public $jam_mulai;
    public $duration = 1; 

    public function mount()
    {
        $this->tanggal_sewa = date('Y-m-d');
        $this->loadCart();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['rent_type', 'duration'])) {
            if ($this->duration < 1) {
                $this->duration = 1;
            }
            
            if ($this->rent_type === 'perjam' && $this->duration > 23) {
                $this->duration = 23; 
            }

            $cart = session()->get('cart', []);
            foreach ($cart as $key => $item) {
                $cart[$key]['rent_type'] = $this->rent_type;
                $cart[$key]['duration'] = $this->duration;
            }
            session()->put('cart', $cart);
        }

        $this->loadCart();
    }

    public function loadCart()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            $this->cartItems = [];
            $this->total = 0;
            return;
        }

        $products = Barang::whereIn('Kode_Barang', array_keys($cart))->get();
        
        $this->cartItems = [];
        $this->total = 0;

        foreach ($products as $product) {
            $itemSession = $cart[$product->Kode_Barang];

            $hargaSatuan = $this->rent_type === 'perjam' 
                ? $product->Harga_Perjam 
                : $product->Harga_Perhari;

            
            $jumlahBarang = $itemSession['Jumlah_Barang'] ?? 1;

            // Total per item = Harga Satuan * Jumlah Barang * Durasi Global
            $subtotal = $hargaSatuan * $jumlahBarang * $this->duration;
            
            $this->total += $subtotal;

            $this->cartItems[] = [
                'kode_barang'   => $product->Kode_Barang,
                'nama_barang'   => $product->Nama_Barang,
                'gambar_barang' => $product->Gambar_Barang,
                'kategori'      => $product->Kategori_Barang,
                'stok'          => $product->Stok, 
                'harga_satuan'  => $hargaSatuan,
                'Jumlah_Barang' => $jumlahBarang, 
                'subtotal'      => $subtotal
            ];
        }
    }

    // Fungsi pengatur kuantitas diubah parameternya
    public function changeQuantity($kodeBarang, $amount)
    {
        $cart = session()->get('cart', []);
        $product = Barang::where('Kode_Barang', $kodeBarang)->first();

        if (isset($cart[$kodeBarang])) {
            // Mengambil key Jumlah_Barang dari session
            $newQty = ($cart[$kodeBarang]['Jumlah_Barang'] ?? 1) + $amount;

            // Validasi berdasarkan kolom Stok di database
            if ($newQty >= 1 && $newQty <= $product->Stok) {
                $cart[$kodeBarang]['Jumlah_Barang'] = $newQty;
                session()->put('cart', $cart);
                $this->loadCart();
            }
        }
    }

    public function removeItem($kodeBarang)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$kodeBarang])) {
            unset($cart[$kodeBarang]);
            session()->put('cart', $cart);
            $this->loadCart();
        }
    }
};
?>

<div>
    {{-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius --}}
</div>