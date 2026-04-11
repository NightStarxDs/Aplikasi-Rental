<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Transaksiontroller extends Controller
{
    public function index()
    {
        return view('User.Halaman_Penjualan');
    }
}
