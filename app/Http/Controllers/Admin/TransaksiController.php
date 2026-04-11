<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    Public function index()
    {
        return view('Admin.Admin_Transaksi');
    }

    Public function Edit_Transaksi()
    {
        return view('Admin.Admin_Edit_Transaksi');
    }

    Public function Hapus_Transaksi()
    {
        return view('Admin.Admin_Transaksi');
    }

    Public function Pengambilan_Pengembalian()
    {
        return view('Admin.Admin_Pengambilan_Pengembalian');
    }

    Public function Transaksi_Penyewaan()
    {
        return view('Admin.Admin_Transaksi_Penyewaan');
    }
}
