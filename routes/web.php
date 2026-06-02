<?php
require __DIR__ . '/auth.php';
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBarang;
use App\Models\User;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\User\PenjualanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\RiwayatPelangganController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\User\KeranjangController;


Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::post('/Detail_Barang_Pelanggan', [PenjualanController::class, 'Detail_Barang'])->name('Detail_Barang_Pelanggan');

Route::middleware(['auth'])->group(function () {
    Route::get('/Keranjang', [KeranjangController::class, 'index'])->name('Keranjang');
    Route::post('/Keranjang/tambah/{kode_barang}', [PenjualanController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout/sukses/{kode_rental}', [PenjualanController::class, 'checkoutSuccess'])->name('checkout.success');
});

Route::get('/', function () {
    return view('LandingPage');
});

Route::get('/login2', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/landingpage', function () {
    return view('LandingPage');
})->name('landing');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::get('/DataBarang', [DataBarang::class, 'tampilkan']);

Route::get('/Admin_Edit_User', function () {
    return view('Admin.Admin_Edit_User');
});

Route::get('/Admin_Inventaris_Barang', [BarangController::class, 'index'])->name('Inventaris');

Route::get('/Admin_kelola_Penyewaan', function () {
    return view('Admin.Admin_kelola_Penyewaan');
});

Route::get('/Admin_Kelola_User', function () {

    $users = User::paginate(10);

    return view('Admin.Admin_Kelola_User', compact('users'));

})->name('Kelola_User');

Route::get('/Admin_Riwayat_Pelanggan', function () {
    return view('Admin.Admin_Riwayat_Pelanggan');
});

Route::get('/Admin_Tambah_User', function () {
    return view('Admin.Admin_Tambah_User');
});

Route::get('/Admin_Transaksi_Penyewaan', [TransaksiController::class, 'Transaksi_Penyewaan'])
    ->name('Transaksi');

// Pelanggan
Route::get('/Halaman_Checkout', function () {
    return view('User.Halaman_Checkout');
})->name('Checkout');


Route::get('/Profil_Pelanggan', function () {
    return view('User.Profil_Pelanggan');
});

Route::get('/LandingPage', function () {
    return view('LandingPage');
});

Route::get('/Tambah_Barang', [BarangController::class, 'create'])->name('Tambah_Barang');
Route::post('/Tambah_Barang', [BarangController::class, 'store'])->name('Tambah_Barang.store');

Route::post('/Detail_Barang', [BarangController::class, 'show'])->name('Detail_Barang');

Route::get('/Pengambilan_dan_Pengembalian/{kode_rental}', [TransaksiController::class, 'pengambilanPengembalian'])
    ->name('Pengambilan_dan_Pengembalian');

Route::post('/Pengambilan_dan_Pengembalian/{kode_rental}', [TransaksiController::class, 'updatePengembalian'])
    ->name('Pengambilan_dan_Pengembalian.update');

Route::get('/Edit_User', function () {
    return view('Admin.Admin_Edit_User');
})->name('Edit_User');

Route::get('/Tambah_User', function () {
    return view('Admin.Admin_Tambah_User');
})->name('Tambah_User');

Route::get('/admin/users/{id}/history', [RiwayatPelangganController::class, 'riwayat'])
    ->name('admin.users.history');

Route::get('/Detail_Barang_Pelanggan/{id}', function () {
    return view('User.Detail_Barang_Pelanggan');
})->name('Detail_Barang_Pelanggan');



Route::post('/Edit_Barang', [BarangController::class, 'edit'])->name('Edit_Barang');
Route::put('/Edit_Barang', [BarangController::class, 'update'])->name('Edit_Barang.update');

Route::delete('/barang/{kode_barang}', [BarangController::class, 'destroy'])
    ->name('barang.destroy');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Resource CRUD: index, create, store, show, edit, update, destroy
Route::resource('users', PelangganController::class)->except(['show']);

    // Rute tambahan: riwayat transaksi pelanggan
Route::get('users/{user}/history', [PelangganController::class, 'history'])
        ->name('users.history');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/users/{user}/edit', [PelangganController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [PelangganController::class, 'update'])
        ->name('users.update');

});