<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('User.Halaman_Penjualan');
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
