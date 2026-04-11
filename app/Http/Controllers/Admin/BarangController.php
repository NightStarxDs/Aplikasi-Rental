<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('Admin.Admin_Inventaris_Barang');
    }

    public function Tambah_Barang()
    {
        return view('Admin.Admin_Tambah_Barang');
    }

    public function Edit_Barang()
    {
        return view('Admin.Admin_Edit_Barang');
    }

    public function Hapus_Barang()
    {
        return view('Admin.Admin_Inventaris_Barang');
    }

    public function Detail_Barang()
    {
        return view('Admin.Admin_Detail_Barang');
    }
}
