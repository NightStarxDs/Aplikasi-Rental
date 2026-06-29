<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rental;
use App\Models\Detail_Rental;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;

class Checkout extends Component
{
    use WithFileUploads;

    public $checkoutData = [];
    public $paymentMethod = 'COD';
    public $isLoading = false;
    public $showDataIncompleteModal = false;
    public $snapToken;

    public function mount()
    {
        $this->checkoutData = session()->get('checkout_data', []);

        if (empty($this->checkoutData)) {
            return redirect()->route('Keranjang');
        }
    }

    public function processCheckout()
    {
        // Cek kelengkapan data user
        $user = Auth::user();
        if (empty($user->telepon) || empty($user->alamat)) {
            $this->showDataIncompleteModal = true;
            return;
        }

        // Validation for payment method
        if (!in_array($this->paymentMethod, ['COD', 'Midtrans'])) {
            $this->paymentMethod = 'COD';
        }

        $this->isLoading = true;

        // ─── COD: langsung buat rental di DB ─────────────────────────────────
        if ($this->paymentMethod === 'COD') {
            DB::beginTransaction();
            try {
                $rental = Rental::create([
                    'id_user'              => Auth::id(),
                    'waktu_sewa'           => $this->checkoutData['waktu_sewa'],
                    'waktu_kembali'        => $this->checkoutData['waktu_kembali'],
                    'waktu_kembali_aktual' => $this->checkoutData['waktu_kembali'],
                    'total_harga'          => $this->checkoutData['total_harga'],
                    'total_denda'          => 0.0,
                    'status_rental'        => 'Diajukan',
                    'metode_pembayaran'    => 'COD',
                    'bukti_pembayaran'     => null,
                ]);

                foreach ($this->checkoutData['items'] as $kodeBarang => $item) {
                    $hargaSatuan  = $this->checkoutData['kategori'] === 'jam'
                        ? $item['harga_perjam']
                        : $item['harga_perhari'];
                    $subtotalItem = $hargaSatuan * $item['qty'] * $this->checkoutData['durasi'];

                    // Validasi stok
                    $barangModel = \App\Models\Barang::find($kodeBarang);
                    if (!$barangModel || $barangModel->stok < $item['qty']) {
                        DB::rollBack();
                        $namaBarang = $barangModel->nama_barang ?? 'Barang';
                        session()->flash('error', "Stok {$namaBarang} tidak mencukupi. Stok tersisa: " . ($barangModel->stok ?? 0));
                        $this->isLoading = false;
                        return;
                    }

                    Detail_Rental::create([
                        'kode_rental'         => $rental->kode_rental,
                        'kode_barang'         => $kodeBarang,
                        'jumlah_barang'       => $item['qty'],
                        'catatan_kondisi'     => 'Baik',
                        'denda_keterlambatan' => 0.0,
                        'denda_kerusakan'     => 0.0,
                        'subtotal'            => $subtotalItem,
                        'status_detail'       => 'Menunggu',
                    ]);

                    // Hapus dari keranjang
                    $cart = session()->get('cart', []);
                    if (isset($cart[$kodeBarang])) {
                        unset($cart[$kodeBarang]);
                    }
                    session()->put('cart', $cart);
                }

                session()->forget('checkout_data');
                DB::commit();

                return redirect()->route('checkout.success', ['kode_rental' => $rental->kode_rental]);

            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
                $this->isLoading = false;
                return;
            }
        }

        // ─── MIDTRANS: hanya dapatkan snap token — JANGAN buat rental dulu ───
        // Rental hanya dibuat di handlePaymentSuccess saat JS melaporkan sukses.
        try {
            Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized  = env('MIDTRANS_IS_SANITIZED', true);
            Config::$is3ds        = env('MIDTRANS_IS_3DS', true);

            // Buat order_id sementara yang unik (belum disimpan ke DB)
            $tempOrderId = 'OUTRENT-' . Auth::id() . '-' . uniqid('', true);

            $params = [
                'transaction_details' => [
                    'order_id'     => $tempOrderId,
                    'gross_amount' => (int) $this->checkoutData['total_harga'],
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email'      => Auth::user()->email,
                    'phone'      => Auth::user()->telepon ?? Auth::user()->phone ?? '',
                ],
            ];

            $this->snapToken = Snap::getSnapToken($params);

            // Simpan nonce di session sebagai guard idempotency.
            // handlePaymentSuccess hanya bisa dieksekusi SEKALI per tempOrderId ini.
            session(['midtrans_pending_order' => $tempOrderId]);

            $this->dispatch('snap-pay', token: $this->snapToken, temp_order_id: $tempOrderId);
            return;

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
            $this->isLoading = false;
        }
    }

    /**
     * Dipanggil dari JS saat Midtrans melaporkan pembayaran SUKSES.
     * Guard session memastikan ini hanya diproses SATU KALI.
     * Hard refresh atau double-call akan ditolak oleh guard.
     */
    #[Livewire\Attributes\On('payment-success')]
    public function handlePaymentSuccess($tempOrderId, $midtransResult = [])
    {
        // ── GUARD: Pastikan ini adalah payment yang sedang aktif ──────────────
        // Jika session tidak cocok (sudah diproses, expired, atau hard refresh
        // setelah cancel), tolak eksekusi.
        if (session('midtrans_pending_order') !== $tempOrderId) {
            $this->isLoading = false;
            return;
        }

        // Hapus nonce SEBELUM proses DB — mencegah double-processing
        session()->forget('midtrans_pending_order');

        DB::beginTransaction();
        try {
            $rental = Rental::create([
                'id_user'              => Auth::id(),
                'waktu_sewa'           => $this->checkoutData['waktu_sewa'],
                'waktu_kembali'        => $this->checkoutData['waktu_kembali'],
                'waktu_kembali_aktual' => $this->checkoutData['waktu_kembali'],
                'total_harga'          => $this->checkoutData['total_harga'],
                'total_denda'          => 0.0,
                'status_rental'        => 'Diajukan',  // Sudah bayar → langsung Diajukan
                'metode_pembayaran'    => 'Midtrans',
                'bukti_pembayaran'     => null,
            ]);

            foreach ($this->checkoutData['items'] as $kodeBarang => $item) {
                $hargaSatuan  = $this->checkoutData['kategori'] === 'jam'
                    ? $item['harga_perjam']
                    : $item['harga_perhari'];
                $subtotalItem = $hargaSatuan * $item['qty'] * $this->checkoutData['durasi'];

                Detail_Rental::create([
                    'kode_rental'         => $rental->kode_rental,
                    'kode_barang'         => $kodeBarang,
                    'jumlah_barang'       => $item['qty'],
                    'catatan_kondisi'     => 'Baik',
                    'denda_keterlambatan' => 0.0,
                    'denda_kerusakan'     => 0.0,
                    'subtotal'            => $subtotalItem,
                    'status_detail'       => 'Menunggu',
                ]);

                // Kurangi stok karena pembayaran sudah dikonfirmasi
                $barangModel = \App\Models\Barang::find($kodeBarang);
                if ($barangModel) {
                    $barangModel->stok -= $item['qty'];
                    $barangModel->syncStatus();
                }

                // Hapus dari keranjang
                $cart = session()->get('cart', []);
                if (isset($cart[$kodeBarang])) {
                    unset($cart[$kodeBarang]);
                }
                session()->put('cart', $cart);
            }

            session()->forget('checkout_data');
            DB::commit();

            return redirect()->route('checkout.success', ['kode_rental' => $rental->kode_rental]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Pembayaran diterima tapi gagal menyimpan transaksi: ' . $e->getMessage());
            $this->isLoading = false;
        }
    }

    /**
     * Dipanggil dari JS saat popup Midtrans ditutup tanpa bayar,
     * atau terjadi error. Cukup bersihkan state — tidak ada rental di DB.
     */
    #[Livewire\Attributes\On('payment-cancelled')]
    public function handlePaymentCancelled($tempOrderId = null)
    {
        // Hapus nonce dari session agar hard refresh tidak bisa memicu payment success
        session()->forget('midtrans_pending_order');
        $this->isLoading = false;
        $this->snapToken = null;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
