<?php
require __DIR__ . '/auth.php';
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBarang;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login2', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/DataBarang', [DataBarang::class, 'tampilkan']);

Route::get('/Admin_Edit_Barang', function () {
    return view('Admin.Admin_Edit_Barang');
});

Route::get('/Admin_Edit_User', function () {
    return view('Admin.Admin_Edit_User');
});

Route::get('/Admin_Inventaris_Barang', function () {
    return view('Admin.Admin_Inventaris_Barang');
});

Route::get('/Admin_kelola_Penyewaan', function () {
    return view('Admin.Admin_kelola_Penyewaan');
});

Route::get('/Admin_Edit_User', function () {
    return view('Admin.Admin_Edit_User');
});

Route::get('/Admin_Riwayat_Pelanggan', function () {
    return view('Admin.Admin_Riwayat_Pelanggan');
});

Route::get('/Admin_Tambah_User', function () {
    return view('Admin.Admin_Tambah_User');
});

Route::get('/Admin_Transaksi_Penyewaan', function () {
    return view('Admin.Admin_Transaksi_Penyewaan');
});

Route::get('/Admin_Edit_Barang', function () {
    return view('Admin.Admin_Edit_Barang');
});

// Pelanggan
Route::get('/Halaman_Checkout', function () {
    return view('User.Halaman_Checkout');
});

Route::get('/Halaman_Keranjang', function () {
    return view('User.Halaman_Keranjang');
});

Route::get('/Halaman_Penjualan', function () {
    return view('User.Halaman_Penjualan');
});

Route::get('/Profil_Pelanggan', function () {
    return view('User.Profil_Pelanggan');
});