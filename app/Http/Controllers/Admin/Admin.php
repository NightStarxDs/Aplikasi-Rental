<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    Public function index()
    {
        return view('Admin.Dashboard');
    }

    public function Profil_Admin()
    {
        return view('Admin.Profil_Admin');
    }

}
