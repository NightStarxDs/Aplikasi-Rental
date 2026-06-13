<div class="min-h-screen bg-slate-100/80 p-3 lg:p-4">
    <div class="mx-auto max-w-6xl space-y-4">
        
        {{-- Flash Messages --}}
        @if(session()->has('error'))
            <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700 font-medium">
                {{ session('error') }}
            </div>
        @endif

        <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
            <h2 class="text-base font-semibold text-slate-900">Detail Penyewa</h2>
            <div class="mt-4 grid grid-cols-1 gap-3 text-xs text-slate-700 sm:text-sm md:grid-cols-3">
                <p class="rounded-md bg-slate-50 px-3 py-2 break-words">{{ auth()->user()->name ?? 'Guest' }}</p>
                <p class="rounded-md bg-slate-50 px-3 py-2 break-words md:text-center">{{ auth()->user()->phone ?? '-' }}</p>
                <p class="rounded-md bg-slate-50 px-3 py-2 break-words md:text-right">{{ auth()->user()->email ?? '-' }}</p>
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
            <div class="hidden grid-cols-12 gap-3 border-b border-slate-200 pb-3 text-xs font-semibold uppercase tracking-wide text-slate-600 md:grid">
                <p class="col-span-5">Produk</p>
                <p class="col-span-2 text-center">Harga Satuan</p>
                <p class="col-span-1 text-center">Kuantitas</p>
                <p class="col-span-2 text-center">Durasi Penyewaan</p>
                <p class="col-span-2 text-right">Subtotal</p>
            </div>

            <div class="space-y-2.5 pt-2">
                @foreach ($checkoutData['items'] as $kode => $item)
                    @php
                        $hargaSatuan = $checkoutData['kategori'] === 'jam' ? $item['harga_perjam'] : $item['harga_perhari'];
                        $subtotalItem = $hargaSatuan * $item['qty'] * $checkoutData['durasi'];
                        $gambar = is_array($item['gambar_barang']) && count($item['gambar_barang']) > 0 ? asset('storage/' . $item['gambar_barang'][0]) : null;
                    @endphp
                    <article class="grid grid-cols-1 gap-3 rounded-lg border border-transparent px-2.5 py-3 transition hover:border-emerald-200 hover:bg-emerald-50/40 md:grid-cols-12 md:items-center">
                        <div class="col-span-5 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($gambar)
                                    <img src="{{ $gambar }}" alt="{{ $item['nama_barang'] }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 md:hidden">Produk</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $item['nama_barang'] }}</p>
                                <p class="text-xs text-gray-400">{{ $item['kategori_barang'] }}</p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-slate-500 md:hidden">Harga Satuan</p>
                            <p class="text-sm text-slate-700 md:text-center">Rp{{ number_format($hargaSatuan, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-xs text-slate-500 md:hidden">Kuantitas</p>
                            <p class="text-sm font-semibold text-slate-800 md:text-center">{{ $item['qty'] }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-slate-500 md:hidden">Durasi Penyewaan</p>
                            <p class="text-sm font-semibold text-slate-800 md:text-center">{{ $checkoutData['durasi'] }} {{ ucfirst($checkoutData['kategori']) }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-slate-500 md:hidden">Subtotal</p>
                            <p class="text-sm font-semibold text-slate-900 md:text-right">Rp{{ number_format($subtotalItem, 0, ',', '.') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-3 w-full lg:w-1/2">
                    <h3 class="text-base font-semibold text-slate-900">Metode Pembayaran</h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === 'COD' ? 'border-emerald-600 bg-emerald-50 shadow-sm' : 'border-slate-300 bg-white hover:border-emerald-300' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="COD" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500"
                                onchange="Swal.fire({
                                    icon: 'info',
                                    title: 'Informasi Pembayaran',
                                    text: 'Untuk pembayaran COD dilakukan pada saat pengambilan ditoko',
                                    confirmButtonColor: '#047857'
                                })">
                            <span class="text-sm font-medium {{ $paymentMethod === 'COD' ? 'text-emerald-700' : 'text-slate-700' }}">COD (Bayar di Tempat)</span>
                        </label>

                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === 'Transfer Bank' ? 'border-emerald-600 bg-emerald-50 shadow-sm' : 'border-slate-300 bg-white hover:border-emerald-300' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="Transfer Bank" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm font-medium {{ $paymentMethod === 'Transfer Bank' ? 'text-emerald-700' : 'text-slate-700' }}">Transfer Bank</span>
                        </label>

                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition {{ $paymentMethod === 'QRIS' ? 'border-emerald-600 bg-emerald-50 shadow-sm' : 'border-slate-300 bg-white hover:border-emerald-300' }}">
                            <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="QRIS" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <span class="text-sm font-medium {{ $paymentMethod === 'QRIS' ? 'text-emerald-700' : 'text-slate-700' }}">QRIS</span>
                        </label>
                    </div>

                    {{-- Info Tujuan Pembayaran --}}
                    @if($paymentMethod === 'QRIS')
                        <div class="mt-4 p-4 border border-slate-200 bg-white rounded-lg flex flex-col items-center justify-center">
                            <p class="text-sm font-semibold text-slate-800 mb-2">Scan QRIS Berikut</p>
                            <div class="w-40 h-40 bg-slate-100 border border-slate-200 rounded flex items-center justify-center p-2 mb-2">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=AplikasiRentalQRIS" alt="QRIS Code" class="w-full h-full object-contain">
                            </div>
                            <p class="text-xs text-slate-500">a.n Dwi Agung</p>
                        </div>
                    @elseif($paymentMethod === 'Transfer Bank')
                        <div class="mt-4 p-4 border border-slate-200 bg-white rounded-lg">
                            <p class="text-sm font-semibold text-slate-800 mb-3">Transfer ke salah satu rekening berikut:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="p-3 border border-slate-100 bg-slate-50 rounded-lg text-center">
                                    <p class="text-xs font-semibold text-blue-800 uppercase tracking-wider mb-1">BCA</p>
                                    <p class="text-sm font-bold text-slate-800 tracking-widest">1234567890</p>
                                    <p class="text-xs text-slate-500 mt-1">a.n Dwi Agung</p>
                                </div>
                                <div class="p-3 border border-slate-100 bg-slate-50 rounded-lg text-center">
                                    <p class="text-xs font-semibold text-orange-600 uppercase tracking-wider mb-1">BNI</p>
                                    <p class="text-sm font-bold text-slate-800 tracking-widest">1234567890</p>
                                    <p class="text-xs text-slate-500 mt-1">a.n Dwi Agung</p>
                                </div>
                                <div class="p-3 border border-slate-100 bg-slate-50 rounded-lg text-center">
                                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Mandiri</p>
                                    <p class="text-sm font-bold text-slate-800 tracking-widest">1234567890</p>
                                    <p class="text-xs text-slate-500 mt-1">a.n Dwi Agung</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Upload Bukti Pembayaran untuk QRIS / Transfer Bank --}}
                    @if($paymentMethod === 'QRIS' || $paymentMethod === 'Transfer Bank')
                        <div class="mt-4 p-4 border border-emerald-100 bg-emerald-50/30 rounded-lg">
                            <p class="text-sm font-medium text-slate-800 mb-2">Upload Bukti Pembayaran</p>
                            <input type="file" wire:model="buktiPembayaran" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-50 file:text-emerald-700
                                hover:file:bg-emerald-100
                            "/>
                            <div wire:loading wire:target="buktiPembayaran" class="text-xs text-emerald-600 mt-2">Uploading...</div>
                            @error('buktiPembayaran') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="mt-4 rounded-md bg-amber-50 p-3 border border-amber-200">
                        <p class="text-xs text-amber-800 font-medium italic">Note: Untuk jaminan penyewaan, kami akan meminta KTM/KTP asli Anda sebagai jaminan utama pada saat pengambilan barang.</p>
                    </div>
                </div>

                <div class="w-full max-w-sm space-y-3 rounded-lg bg-slate-50 p-3.5 border border-slate-200">
                    <div class="flex items-center justify-between text-sm text-slate-700">
                        <p>Total Item</p>
                        <p class="font-medium">{{ count($checkoutData['items']) }} Produk</p>
                    </div>
                    <div class="flex items-center justify-between text-sm text-slate-700">
                        <p>Subtotal Pesanan</p>
                        <p class="font-semibold text-slate-900">Rp{{ number_format($checkoutData['total_harga'], 0, ',', '.') }}</p>
                    </div>
                    <div class="border-t border-slate-200 pt-3">
                        <div class="flex items-center justify-between text-xl font-semibold text-slate-900">
                            <p>Total Pembayaran</p>
                            <p class="text-emerald-700">Rp{{ number_format($checkoutData['total_harga'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-between items-center border-t border-slate-100 pt-5">
                <a href="{{ route('Keranjang') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-800">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Kembali ke Keranjang
                </a>
                <button 
                    wire:click="processCheckout" 
                    wire:loading.attr="disabled"
                    class="min-w-40 rounded-lg inline-flex justify-center items-center gap-2 bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/70 active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="processCheckout">Proses Pembayaran</span>
                    <span wire:loading wire:target="processCheckout">Memproses...</span>
                </button>
            </div>
        </section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($showDataIncompleteModal)
    <!-- Modal Incomplete Data -->
    <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/60 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 md:p-8 transform transition-all text-center">
            
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-600 text-red-500 mb-4 shadow-sm">
                <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>

            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">Data Belum Lengkap</h3>
            <p class="text-sm text-gray-500 mb-6">Anda harus melengkapi data profil (alamat dan nomor telepon) sebelum dapat melanjutkan proses penyewaan barang.</p>

            <div class="flex flex-col gap-3">
                <a href="{{ route('user.profile') }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 text-white font-bold rounded-xl shadow-md hover:bg-emerald-700 transition">
                    Lengkapi Data Sekarang
                </a>
                <button wire:click="$set('showDataIncompleteModal', false)" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">
                    Batal
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
