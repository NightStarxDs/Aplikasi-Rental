<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return view('Admin.Admin_Kelola_User');
    }

    public function Riwayat_Pelanggan()
    {
        return view('Admin.Admin_Riwayat_Pelanggan');
    }

    public function Tambah_User()
    {
        return view('Admin.Admin_Tambah_User');
    }

    public function Edit_User()
    {
        return view('Admin.Admin_Edit_User');
    }

    public function Hapus_User()
    {
        return view('Admin.Admin_Kelola_User');
    }
}
