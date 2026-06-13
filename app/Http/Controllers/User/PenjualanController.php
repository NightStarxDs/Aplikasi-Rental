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
        
        $query = Barang::where('status_barang', '!=', 'Tidak Tersedia');

        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_barang', $request->kategori);
        }

        if ($request->has('subkategori') && $request->subkategori != '') {
            $query->where('subkategori_barang', $request->subkategori);
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
