<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;
use App\Models\Detail_Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $kategori = 'jam'; // 'jam' atau 'hari'
    public $jam_tgl;
    public $jam_mulai;
    public $durasi_jam = 1;
    public $hari_tgl_mulai;
    public $hari_tgl_kembali;

    public $cartItems = [];
    public $selectedItems = [];
    public $pilihSemua = false;

    public function mount()
    {
        $this->jam_tgl = date('Y-m-d');
        $this->jam_mulai = date('H:i');
        $this->hari_tgl_mulai = date('Y-m-d');
        $this->hari_tgl_kembali = date('Y-m-d', strtotime('+1 day'));

        // Ambil data dari Session 'cart' yang diisi dari halaman detail
        $this->cartItems = session()->get('cart', []);
    }

    public function gantiKategori($kat)
    {
        $this->kategori = $kat;
        $this->selectedItems = [];
        $this->pilihSemua = false;
    }

    public function ubahDurasiJam($n)
    {
        $next = $this->durasi_jam + $n;
        if ($next >= 1 && $next <= 23) {
            $this->durasi_jam = $next;
        }
    }

    public function ubahQty($kodeBarang, $n)
    {
        if (isset($this->cartItems[$kodeBarang])) {
            $nextQty = $this->cartItems[$kodeBarang]['qty'] + $n;
            if ($nextQty >= 1 && $nextQty <= 10) {
                $this->cartItems[$kodeBarang]['qty'] = $nextQty;
                
                // Sinkronisasikan perubahan kuantitas ke session
                session()->put('cart', $this->cartItems);
            }
        }
    }

    public function hapusItem($kodeBarang)
    {
        unset($this->cartItems[$kodeBarang]);
        
        // Sinkronisasikan penghapusan ke session
        session()->put('cart', $this->cartItems);
        
        $this->selectedItems = array_values(array_diff($this->selectedItems, [$kodeBarang]));
        $this->updatedSelectedItems();
    }

    public function updatedPilihSemua($value)
    {
        if ($value) {
            $this->selectedItems = array_values(array_map('strval', array_keys($this->cartItems)));
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        $this->selectedItems = array_values(array_map('strval', $this->selectedItems));

        if (count($this->selectedItems) === count($this->cartItems) && count($this->cartItems) > 0) {
            $this->pilihSemua = true;
        } else {
            $this->pilihSemua = false;
        }
    }

    public function getDurasiProperty()
    {
        if ($this->kategori === 'jam') {
            return $this->durasi_jam;
        }
        if ($this->hari_tgl_mulai && $this->hari_tgl_kembali) {
            $mulai = Carbon::parse($this->hari_tgl_mulai);
            $kembali = Carbon::parse($this->hari_tgl_kembali);
            $selisih = $mulai->diffInDays($kembali);
            return $selisih > 0 ? $selisih : 0;
        }
        return 0;
    }

    public function getGrandTotalProperty()
    {
        $total = 0;
        $durasi = $this->durasi;

        foreach ($this->cartItems as $kode => $item) {
            if (in_array((string)$kode, $this->selectedItems)) {
                $harga = $this->kategori === 'jam' ? $item['harga_perjam'] : $item['harga_perhari'];
                $total += $harga * $item['qty'] * $durasi;
            }
        }
        return $total;
    }

    public function checkout()
    {
        if (empty($this->selectedItems)) {
            session()->flash('error', 'Pilih barang yang ingin disewa terlebih dahulu.');
            return;
        }

        if ($this->durasi <= 0) {
            session()->flash('error', 'Durasi penyewaan tidak valid.');
            return;
        }

        if ($this->kategori === 'jam') {
            $waktu_sewa = Carbon::parse(($this->jam_tgl ?: date('Y-m-d')) . ' ' . ($this->jam_mulai ?: date('H:i:s')));
            $waktu_kembali = Carbon::parse($waktu_sewa)->addHours($this->durasi_jam);
        } else {
            $waktu_sewa = Carbon::parse(($this->hari_tgl_mulai ?: date('Y-m-d')) . ' 00:00:00');
            $tgl_kembali = $this->hari_tgl_kembali ?: date('Y-m-d', strtotime('+1 day'));
            $waktu_kembali = Carbon::parse($tgl_kembali . ' 23:59:59');
        }

        $checkoutItems = [];
        foreach ($this->cartItems as $kodeBarang => $item) {
            if (in_array((string)$kodeBarang, $this->selectedItems)) {
                $checkoutItems[$kodeBarang] = $item;
            }
        }

        session()->put('checkout_data', [
            'items' => $checkoutItems,
            'kategori' => $this->kategori,
            'durasi' => $this->durasi,
            'waktu_sewa' => $waktu_sewa,
            'waktu_kembali' => $waktu_kembali,
            'total_harga' => $this->grandTotal,
        ]);

        return redirect()->route('Checkout');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}