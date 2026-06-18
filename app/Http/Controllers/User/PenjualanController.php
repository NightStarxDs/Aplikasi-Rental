<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use App\Models\Barang;
use App\Models\Rental;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Barang::where('status_barang', '!=', 'Tidak Tersedia')
                       ->where('stok', '>', 0);

        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_barang', $request->kategori);
        }

        if ($request->has('subkategori') && $request->subkategori != '') {
            $query->where('subkategori_barang', $request->subkategori);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('kategori_barang', 'like', '%' . $search . '%')
                  ->orWhere('subkategori_barang', 'like', '%' . $search . '%');
            });
        }

        $barang = $query->get();
        
        $checkoutRental = null;
        if (session('checkout_success_kode')) {
            $checkoutRental = \App\Models\Rental::with('detailRentals.barang', 'user')
                ->where('kode_rental', session('checkout_success_kode'))
                ->first();
        }

        return view('User.Halaman_Penjualan', compact('barang', 'checkoutRental'));
    }

    public function Detail_Barang(Request $request)
    {
        $id = $request->input('id');
        $barang = Barang::where('kode_barang', $id)->firstOrFail();
        
        $totalPernahDisewa = \App\Models\Detail_Rental::where('kode_barang', $id)
                            ->whereHas('rental', function ($q) {
                                $q->whereIn('status_rental', ['Disewa', 'Dikembalikan', 'Selesai']);
                            })
                            ->sum('jumlah_barang');
                            
        $barang->total_disewa = $totalPernahDisewa;

        return view('User.Detail_Barang_Pelanggan', compact('barang'));
    }
    
    public function addToCart(Request $request, $kode_barang) {
        $barang = Barang::findOrFail($kode_barang);
        $qty    = max(1, (int) $request->input('qty', 1));

        // Tolak jika stok habis
        if ($barang->stok <= 0) {
            return redirect()->route('Detail_Barang_Pelanggan', ['id' => $kode_barang])
                ->with('error', 'Stok barang ini sudah habis.');
        }

        // Batas maksimal per pelanggan per barang: min(3, stok)
        $maxPerPelanggan = min(3, $barang->stok);

        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$kode_barang]) ? $cart[$kode_barang]['qty'] : 0;
        $newQty     = $currentQty + $qty;

        // Tidak boleh melebihi batas max (3 atau stok jika < 3)
        if ($newQty > $maxPerPelanggan) {
            $sisa = $maxPerPelanggan - $currentQty;
            if ($sisa <= 0) {
                return redirect()->route('Detail_Barang_Pelanggan', ['id' => $kode_barang])
                    ->with('error', "Anda sudah mencapai batas maksimal penyewaan ({$maxPerPelanggan} unit) untuk barang ini.");
            }
            $newQty = $maxPerPelanggan;
        }

        // Tidak boleh melebihi stok yang tersedia
        $newQty = min($newQty, $barang->stok);

        if (isset($cart[$kode_barang])) {
            $cart[$kode_barang]['qty'] = $newQty;
        } else {
            $cart[$kode_barang] = [
                "kode_barang"    => $barang->kode_barang,
                "nama_barang"    => $barang->nama_barang,
                "kategori_barang"=> $barang->kategori_barang,
                "harga_perjam"   => $barang->harga_perjam,
                "harga_perhari"  => $barang->harga_perhari,
                "gambar_barang"  => $barang->gambar_barang,
                "qty"            => $newQty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('Detail_Barang_Pelanggan', ['id' => $kode_barang])->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    public function Profil_Pelanggan()
    {
        return view('User.Profil_Pelanggan');
    }

    public function Checkout()
    {
        return view('User.Halaman_Checkout');
    }

    public function Keranjang()
    {
        return view('User.Halaman_Keranjang');
    }

    public function checkoutSuccess($kode_rental)
    {
        return redirect()->route('penjualan.index')->with('checkout_success_kode', $kode_rental);
    }

    public function storeUlasan(Request $request)
    {
        $request->validate([
            'bintang' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        \App\Models\Ulasan::create([
            'id_user' => auth()->id(),
            'bintang' => $request->bintang,
            'komentar' => $request->komentar,
        ]);

        return response()->json(['success' => true, 'message' => 'Ulasan berhasil dikirim!']);
    }
}
