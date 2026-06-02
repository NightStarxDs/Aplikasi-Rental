<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use App\Models\Barang;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Barang::where('status_barang', '!=', 'Tidak Tersedia');

        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_barang', $request->kategori);
        }

        if ($request->has('subkategori') && $request->subkategori != '') {
            $query->where('subkategori_barang', $request->subkategori);
        }

        $barang = $query->get();

        return view('User.Halaman_Penjualan', compact('barang'));
    }

    public function Detail_Barang(Request $request)
    {
        $id = $request->input('id');
        $barang = Barang::where('kode_barang', $id)->firstOrFail();
        return view('User.Detail_Barang_Pelanggan', compact('barang'));
    }
    
    public function addToCart(Request $request, $kode_barang) {
        $barang = Barang::findOrFail($kode_barang);
        $qty = max(1, (int) $request->input('qty', 1));
        
        $cart = session()->get('cart', []);

        if(isset($cart[$kode_barang])) {
            $cart[$kode_barang]['qty'] = min($cart[$kode_barang]['qty'] + $qty, 10);
        } else {
            $cart[$kode_barang] = [
                "kode_barang" => $barang->kode_barang,
                "nama_barang" => $barang->nama_barang,
                "kategori_barang" => $barang->kategori_barang,
                "harga_perjam" => $barang->harga_perjam,
                "harga_perhari" => $barang->harga_perhari,
                "gambar_barang" => $barang->gambar_barang,
                "qty" => min($qty, 10)
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('Keranjang')->with('success', 'Barang berhasil ditambahkan ke keranjang!');
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
        return redirect()->route('penjualan.index')->with('success', 'Checkout berhasil! Kode Rental: ' . $kode_rental);
    }
}
