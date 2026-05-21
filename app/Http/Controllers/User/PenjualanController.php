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
}
