<x-app3-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Halaman Penjualan</h1>
                <p class="text-sm text-gray-500 mt-1">Temukan dan sewa peralatan yang kamu butuhkan</p>
            </div>
        </div>
    </x-slot>

    <div class="px-6 space-y-5">

        <!-- Hero Banner -->
        <div class="grid grid-cols-3 gap-3 h-48">
            <div class="col-span-2 rounded-2xl overflow-hidden relative">
                <img src="{{ asset('images/Test.jpg') }}" alt="Banner Utama"
                    class="w-full h-full object-cover bg-no-repeat bg-center">
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/Test.jpg') }}" alt="Foto 1"
                        class="w-full h-full object-cover bg-no-repeat bg-center">
                </div>
                <div class="flex-1 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/Test.jpg') }}" alt="Foto 2"
                        class="w-full h-full object-cover bg-no-repeat bg-center">
                </div>
            </div>
        </div>

        <div class="relative rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <!-- Header Utama Card -->
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                    <h2 class="text-xs font-bold text-gray-800 uppercase tracking-widest">Kategori</h2>
                </div>
                <a href="{{ route('penjualan.index') }}" class="text-[10px] font-bold text-emerald-600 hover:text-emerald-700 uppercase tracking-wider flex items-center gap-1 transition">
                    Lihat Semua ➔
                </a>
            </div>

            <!-- Grid Kategori ala E-commerce -->
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-11 border-t border-l border-gray-100 mt-4 rounded-xl overflow-hidden">
                @php
                    $allSubcategories = [
                        ['db' => 'Tenda',             'label' => 'Tenda',        'kategori' => 'Alat Camping', 'img' => 'tent.png'],
                        ['db' => 'Peralatan Tidur',   'label' => 'Sleeping Bag', 'kategori' => 'Alat Camping', 'img' => 'sleeping-bag.png'],
                        ['db' => 'Peralatan Memasak', 'label' => 'Cooking Set',  'kategori' => 'Alat Camping', 'img' => 'cooking-set.png'],
                        ['db' => 'Penerangan',        'label' => 'Penerangan',   'kategori' => 'Alat Camping', 'img' => 'lightbulb.png'],
                        ['db' => 'Power',             'label' => 'Power & Gas',  'kategori' => 'Alat Camping', 'img' => 'power-supply.png'],
                        ['db' => 'DSLR Cam',          'label' => 'DSLR',         'kategori' => 'Kamera',       'img' => 'dslr-camera.png'],
                        ['db' => 'Mirrorless Cam',    'label' => 'Mirrorless',   'kategori' => 'Kamera',       'img' => 'mirrorless.png'],
                        ['db' => 'Video Cam',         'label' => 'Video',        'kategori' => 'Kamera',       'img' => 'video-recorder.png'],
                        ['db' => 'Action Cam',        'label' => 'Action',       'kategori' => 'Kamera',       'img' => 'action-camera.png'],
                        ['db' => 'Lensa',             'label' => 'Lensa',        'kategori' => 'Kamera',       'img' => 'zoom-lens.png'],
                        ['db' => 'Aksesoris Kamera',  'label' => 'Aksesoris',    'kategori' => 'Kamera',       'img' => 'maintenance.png'],
                    ];
                @endphp

                @foreach ($allSubcategories as $sub)
                <a href="{{ route('penjualan.index', ['kategori' => $sub['kategori'], 'subkategori' => $sub['db']]) }}" 
                   class="group border-r border-b border-gray-100 p-3 sm:p-4 flex flex-col items-center justify-between gap-3 bg-white hover:bg-gray-50/50 transition duration-150">
                    
                    <!-- Lingkaran Background Ikon -->
                    <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center transition-all duration-200 group-hover:bg-emerald-50/50 group-hover:scale-105">
                        <img src="{{ asset('Icon/' . $sub['img']) }}" alt="{{ $sub['label'] }}" class="w-8 h-8 object-contain">
                    </div>

                    <!-- Label Kategori -->
                    <span class="text-[11px] font-semibold text-gray-700 text-center leading-tight group-hover:text-emerald-600 transition-colors duration-150 w-full truncate px-0.5">
                        {{ $sub['label'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Produk Kami -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-700">Produk Kami</h2>
                <a href="{{ route('penjualan.index') }}" class="text-xs text-emerald-700 hover:underline font-medium">Lihat semua →</a>
            </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @forelse($barang as $item)
                <form action="{{ route('Detail_Barang_Pelanggan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->kode_barang }}">
                <button type="submit" class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:border-emerald-400 transition flex flex-col">

                    {{-- Gambar Square --}}
                    <div class="aspect-square w-full overflow-hidden bg-gray-100">
                        <img src="{{ $item->fotoUtamaUrl() ?? asset('images/default-placeholder.jpg') }}"
                            alt="{{ $item->nama_barang }}"
                            class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                    </div>

                    {{-- Info --}}
                    <div class="p-2 flex flex-col gap-0.5 text-left">
                        <span class="text-[9px] font-semibold text-emerald-600 uppercase tracking-wider truncate">
                            {{ $item->labelKategori() }} · {{ $item->subkategori_barang }}
                        </span>
                        <h5 class="text-xs font-bold text-gray-800 line-clamp-1 group-hover:text-emerald-700 transition">
                            {{ $item->nama_barang }}
                        </h5>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-xm font-bold text-red-500">
                                Rp {{ number_format($item->harga_perhari, 0, ',', '.') }}
                            </span>
                            <span class="text-[13px] text-gray-400">/ hari</span>
                        </div>
                    </div>
                </button>
                </form>
            @empty
                <div class="col-span-2 md:col-span-4 lg:col-span-6 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Tidak ada produk yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/f19fb034db.js" crossorigin="anonymous"></script>

    @if(isset($checkoutRental))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div x-data="{
        showModal: true,
        ulasanModal: false,
        rating: 5,
        komentar: '',
        submitting: false,
        closeRentalModal() {
            this.showModal = false;
            setTimeout(() => {
                this.ulasanModal = true;
            }, 3000);
        },
        submitUlasan() {
            if (this.rating < 1 || this.rating > 5) return;
            this.submitting = true;
            fetch('{{ route('ulasan.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    bintang: this.rating,
                    komentar: this.komentar
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.ulasanModal = false;
                    Swal.fire({
                        icon: 'success',
                        title: 'Terima Kasih!',
                        text: 'Ulasan Anda sangat berarti bagi kami.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    alert('Gagal mengirim ulasan.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat mengirim ulasan.');
            })
            .finally(() => {
                this.submitting = false;
            });
        }
    }">
    <!-- Popup Modal -->
    <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/60 backdrop-blur-sm p-4" x-transition.opacity>
        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl p-6 md:p-8 transform transition-all" @click.away="closeRentalModal()">
            
            <!-- Close Button -->
            <button @click="closeRentalModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Success Message -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 mb-3 shadow-sm">
                    <i class="fa-solid fa-check text-2xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Checkout Berhasil!</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan kode rental di bawah ini sebagai bukti saat pengambilan barang.</p>
            </div>

            <!-- Visible Info -->
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 mb-6 relative overflow-hidden">
                <!-- Decorative subtle blur -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-2xl opacity-60 pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col items-center justify-center mb-4 pb-4 border-b border-gray-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kode Rental</p>
                        <div class="text-3xl font-extrabold text-emerald-600 font-mono tracking-widest bg-emerald-100/50 px-4 py-1.5 rounded-lg border border-emerald-200 shadow-sm">
                            {{ $checkoutRental->kode_rental }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Penyewa</p>
                            <p class="font-medium text-gray-800">{{ $checkoutRental->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Total Harga</p>
                            <p class="font-bold text-emerald-600">Rp {{ number_format($checkoutRental->total_harga, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Ambil</p>
                            <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($checkoutRental->waktu_sewa)->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-semibold">Kembali</p>
                            <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($checkoutRental->waktu_kembali)->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <button id="download-modal-btn" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-white border-2 border-emerald-500 text-emerald-600 hover:bg-emerald-50 rounded-xl font-bold transition shadow-sm text-sm">
                    <i class="fa-solid fa-download"></i>
                    Unduh Gambar
                </button>
                <a href="{{ route('users.history') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold transition shadow-md text-sm">
                    Lihat Riwayat Transaksi
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Hidden element strictly for html2canvas to avoid layout breakage -->
    <div style="position: absolute; left: -9999px; top: 0;">
        <div id="hidden-rental-proof" style="width: 600px; padding: 40px; background-color: #ffffff; color: #1f2937; font-family: 'Inter', sans-serif; box-sizing: border-box;">
            <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 20px;">
                <h1 style="margin: 0; font-size: 24px; color: #059669; font-weight: 800;">Bukti Penyewaan Barang</h1>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #6b7280;">Aplikasi Penyewaan Alat Camping & Kamera</p>
            </div>

            <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Kode Rental</p>
                    <p style="margin: 5px 0 0 0; font-size: 28px; font-weight: 900; color: #059669; font-family: monospace; letter-spacing: 2px;">{{ $checkoutRental->kode_rental }}</p>
                </div>
                <div style="text-align: right;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; font-weight: bold;">Tanggal Checkout</p>
                    <p style="margin: 5px 0 0 0; font-size: 14px; font-weight: bold;">{{ now()->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div style="margin-bottom: 30px; display: flex; flex-wrap: wrap; background-color: #f9fafb; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px;">
                <div style="width: 50%; margin-bottom: 20px;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Nama Penyewa</p>
                    <p style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">{{ $checkoutRental->user->name }}</p>
                </div>
                <div style="width: 50%; margin-bottom: 20px;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Metode Pembayaran</p>
                    <p style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">{{ $checkoutRental->metode_pembayaran }}</p>
                </div>
                <div style="width: 50%;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Waktu Ambil</p>
                    <p style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">{{ \Carbon\Carbon::parse($checkoutRental->waktu_sewa)->format('d M Y, H:i') }}</p>
                </div>
                <div style="width: 50%;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: bold;">Waktu Kembali</p>
                    <p style="margin: 5px 0 0 0; font-size: 15px; font-weight: bold;">{{ \Carbon\Carbon::parse($checkoutRental->waktu_kembali)->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="margin: 0 0 10px 0; font-size: 15px; font-weight: bold; border-bottom: 2px solid #e5e7eb; padding-bottom: 8px; color: #374151;">Detail Barang</p>
                <table style="width: 100%; border-collapse: collapse;">
                    @foreach($checkoutRental->detailRentals as $detail)
                    <tr>
                        <td style="padding: 12px 0; border-bottom: 1px dashed #e5e7eb;">
                            <p style="margin: 0; font-size: 15px; font-weight: bold; color: #111827;">{{ $detail->barang->nama_barang }}</p>
                            <p style="margin: 4px 0 0 0; font-size: 13px; color: #6b7280;">{{ $detail->jumlah_barang }}x @ Rp {{ number_format($detail->subtotal / max($detail->jumlah_barang, 1), 0, ',', '.') }}</p>
                        </td>
                        <td style="padding: 12px 0; border-bottom: 1px dashed #e5e7eb; text-align: right; font-size: 15px; font-weight: bold; color: #111827;">
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 2px solid #d1d5db; padding-top: 20px; margin-top: 20px;">
                <p style="margin: 0; font-size: 18px; font-weight: bold; text-transform: uppercase; color: #374151;">Total Pembayaran</p>
                <p style="margin: 0; font-size: 26px; font-weight: 900; color: #059669;">Rp {{ number_format($checkoutRental->total_harga, 0, ',', '.') }}</p>
            </div>
            
            <div style="text-align: center; margin-top: 35px; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; padding-top: 15px; font-weight: 500;">
                <strong style="color: #059669;">NightStarxDs</strong> &copy; Di-generate pada {{ now()->format('d M Y, H:i') }}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById('download-modal-btn')?.addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            const proofElement = document.getElementById('hidden-rental-proof');

            setTimeout(() => {
                html2canvas(proofElement, {
                    scale: 3, // Very high resolution for crisp image
                    backgroundColor: '#ffffff',
                    useCORS: true,
                    logging: false,
                    width: 600,
                    height: proofElement.offsetHeight
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Bukti_Rental_{{ $checkoutRental->kode_rental }}.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();

                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Berhasil Diunduh';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, 2000);
                }).catch(err => {
                    console.error("Error generating image", err);
                    alert("Gagal mengunduh gambar.");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }, 100);
        });
    </script>

    <!-- Review Modal -->
    <div x-show="ulasanModal" class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/60 backdrop-blur-sm p-4" x-transition.opacity style="display: none;">
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 md:p-8 transform transition-all text-center" @click.away="ulasanModal = false">
            
            <!-- Close Button -->
            <button @click="ulasanModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 mb-3 shadow-sm">
                <i class="fa-solid fa-star text-2xl text-amber-500"></i>
            </div>
            
            <h2 class="text-xl font-bold text-gray-900">Bagaimana Pengalaman Anda?</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">Berikan ulasan dan rating untuk pesanan Anda agar kami dapat terus meningkatkan layanan.</p>

            <!-- Rating Stars -->
            <div class="flex items-center justify-center gap-2 mb-6">
                <template x-for="i in [1, 2, 3, 4, 5]">
                    <button type="button" @click="rating = i" class="text-3xl focus:outline-none transition-transform hover:scale-110">
                        <i class="fa-star" :class="i <= rating ? 'fa-solid text-amber-400' : 'fa-regular text-gray-300'"></i>
                    </button>
                </template>
            </div>

            <!-- Comment Input -->
            <div class="mb-6">
                <textarea x-model="komentar" rows="4" placeholder="Tulis komentar Anda di sini..." class="w-full text-sm border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 p-3 shadow-sm" required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-2">
                <button type="button" @click="submitUlasan()" :disabled="submitting || !komentar.trim()" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-xl font-bold transition shadow-md text-sm">
                    <span x-show="!submitting">Kirim Ulasan</span>
                    <span x-show="submitting"><i class="fa-solid fa-spinner fa-spin"></i> Mengirim...</span>
                </button>
                <button type="button" @click="ulasanModal = false" class="w-full flex items-center justify-center px-5 py-2 text-xs font-semibold text-gray-500 hover:text-gray-700 transition">
                    Nanti Saja
                </button>
            </div>

        </div>
    </div>
    </div>
    @endif
</x-app3-layout>