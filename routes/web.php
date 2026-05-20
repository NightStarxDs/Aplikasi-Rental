<?php
require __DIR__ . '/auth.php';
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBarang;
use App\Http\Controllers\admin\BarangController;

Route::get('/', function () {
    return view('LandingPage');
});

Route::get('/login2', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/landingpage', function () {
    return view('LandingPage');
})->name('landing');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/DataBarang', [DataBarang::class, 'tampilkan']);

Route::get('/Admin_Edit_User', function () {
    return view('Admin.Admin_Edit_User');
});

Route::get('/Admin_Inventaris_Barang', [BarangController::class, 'index'])->name('Inventaris');

Route::get('/Admin_kelola_Penyewaan', function () {
    return view('Admin.Admin_kelola_Penyewaan');
});

Route::get('/Admin_Kelola_User', function () {
    return view('Admin.Admin_Kelola_User');
})->name('Kelola_User');

Route::get('/Admin_Riwayat_Pelanggan', function () {
    return view('Admin.Admin_Riwayat_Pelanggan');
});

Route::get('/Admin_Tambah_User', function () {
    return view('Admin.Admin_Tambah_User');
});

Route::get('/Admin_Transaksi_Penyewaan', function () {
    return view('Admin.Admin_Transaksi_Penyewaan');
})->name('Transaksi');

// Pelanggan
Route::get('/Halaman_Checkout', function () {
    return view('User.Halaman_Checkout');
})->name('Checkout');

Route::get('/Halaman_Penjualan', function () {
    return view('user.Halaman_Penjualan');
});

Route::get('/Profil_Pelanggan', function () {
    return view('User.Profil_Pelanggan');
});

Route::get('/LandingPage', function () {
    return view('LandingPage');
});

Route::get('/Tambah_Barang', [BarangController::class, 'create'])->name('Tambah_Barang');
Route::post('/Tambah_Barang', [BarangController::class, 'store'])->name('Tambah_Barang.store');

Route::get('/Detail_Barang/{id}', [BarangController::class, 'show'])->name('Detail_Barang');

Route::get('/Pengambilan_dan_Pengembalian', function () {
    return view('Admin.Admin_pengambilan_dan_Pengembalian');
})->name('Pengambilan_dan_Pengembalian');

Route::get('/Edit_User', function () {
    return view('Admin.Admin_Edit_User');
})->name('Edit_User');

Route::get('/Tambah_User', function () {
    return view('Admin.Admin_Tambah_User');
})->name('Tambah_User');

Route::get('/Riwayat_Pelanggan', function () {
    return view('Admin.Admin_Riwayat_Pelanggan');
})->name('Riwayat_Pelanggan');

Route::get('/Penjualan', function () {
    return view('User.Halaman_Penjualan');
})->name('Penjualan');

Route::get('/Detail_Barang_Pelanggan/{id}', function () {
    return view('User.Detail_Barang_Pelanggan');
})->name('Detail_Barang_Pelanggan');

Route::get('/Keranjang', function () {
    return view('user.Keranjang');
})->name('Keranjang');

Route::get('/Edit_Barang/{id}', [BarangController::class, 'edit'])->name('Edit_Barang');
Route::put('/Edit_Barang/{id}', [BarangController::class, 'update'])->name('Edit_Barang.update');

Route::delete('/barang/{kode_barang}', [BarangController::class, 'destroy'])
    ->name('barang.destroy');