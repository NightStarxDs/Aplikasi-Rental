<div class="pt-[30px] px-6 pb-6 space-y-4">

    {{-- Flash Messages --}}
    @if(session()->has('success'))
        <div class="px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700 font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700 font-medium">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pilihan Waktu --}}
    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
            Pilih Waktu Penyewaan dan Pengembalian
        </p>

        {{-- Tab Kategori Durasi --}}
        <div class="flex items-center gap-2 mb-4">
            <button wire:click="gantiKategori('jam')"
                class="px-4 py-1.5 text-xs font-medium rounded-lg border transition {{ $kategori === 'jam' ? 'bg-emerald-700 text-white border-emerald-700' : 'bg-white text-gray-500 border-gray-200 hover:border-emerald-400 hover:text-emerald-600' }}">
                Per Jam
            </button>
            <button wire:click="gantiKategori('hari')"
                class="px-4 py-1.5 text-xs font-medium rounded-lg border transition {{ $kategori === 'hari' ? 'bg-emerald-700 text-white border-emerald-700' : 'bg-white text-gray-500 border-gray-200 hover:border-emerald-400 hover:text-emerald-600' }}">
                Per Hari
            </button>
        </div>

        {{-- Input Per Jam --}}
        @if($kategori === 'jam')
            <div id="panel-jam" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Sewa</label>
                    <input type="date" wire:model.live="jam_tgl"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
                <div class="col-span-1 sm:col-span-2 flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">
                        Durasi (Jam)
                        <span class="text-gray-400 font-normal ml-1">Maks. 23 jam — lebih dari itu gunakan Per Hari</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <button wire:click="ubahDurasiJam(-1)"
                            class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition font-bold text-base">−</button>
                        <span class="text-lg font-semibold text-gray-800 w-8 text-center">{{ $durasi_jam }}</span>
                        <button wire:click="ubahDurasiJam(1)"
                            class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition font-bold text-base">+</button>
                        <span class="text-sm text-gray-400">jam</span>
                    </div>
                </div>
            </div>
        @else
            {{-- Input Per Hari --}}
            <div id="panel-hari" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Mulai Sewa</label>
                    <input type="date" wire:model.live="hari_tgl_mulai"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-medium text-gray-500">Tanggal Kembali</label>
                    <input type="date" wire:model.live="hari_tgl_kembali"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                </div>
            </div>
        @endif

        {{-- Info Durasi --}}
        @if($this->durasi > 0)
            <div class="mt-3 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-xs text-emerald-700 font-medium">
                    Durasi sewa: <span class="font-bold">{{ $this->durasi }} {{ $kategori === 'jam' ? 'Jam' : 'Hari' }}</span>
                </p>
            </div>
        @endif
    </div>

    {{-- Tabel Produk --}}
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <div class="min-w-[800px]">
                {{-- Header Tabel --}}
                <div class="grid grid-cols-12 gap-2 px-4 py-3 bg-gray-50 border-b border-gray-200">
            <div class="col-span-1 flex items-center">
                <input type="checkbox" wire:model.live="pilihSemua"
                    @checked($pilihSemua)
                    class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
            </div>
            <div class="col-span-4 text-xs font-medium text-gray-500">Produk</div>
            <div class="col-span-2 text-xs font-medium text-gray-500 text-center">Harga Satuan</div>
            <div class="col-span-2 text-xs font-medium text-gray-500 text-center">Kuantitas</div>
            <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Durasi</div>
            <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Total</div>
            <div class="col-span-1 text-xs font-medium text-gray-500 text-center">Aksi</div>
        </div>

        {{-- Loop Data Keranjang --}}
        @forelse($cartItems as $kodeBarang => $item)
            @php
                $hargaSatuan = $kategori === 'jam' ? $item['harga_perjam'] : $item['harga_perhari'];
                $subtotalItem = $hargaSatuan * $item['qty'] * $this->durasi;
                $gambar = $item['gambar_barang'] ?? [];
                $fotoUtama = is_array($gambar) && count($gambar) > 0 ? asset('storage/' . $gambar[0]) : null;
            @endphp
            <div wire:key="cart-row-{{ $kodeBarang }}" class="grid grid-cols-12 gap-2 px-4 py-4 border-b border-gray-100 items-center hover:bg-gray-50 transition">
                <div class="col-span-1">
                    <input type="checkbox" wire:model.live="selectedItems" value="{{ (string)$kodeBarang }}"
                        wire:key="checkbox-item-{{ $kodeBarang }}"
                        @checked(in_array((string)$kodeBarang, $selectedItems))
                        class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                </div>
                <div class="col-span-4 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if($fotoUtama)
                            <img src="{{ $fotoUtama }}" alt="{{ $item['nama_barang'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-xs text-gray-400">None</div>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $item['nama_barang'] }}</p>
                        <p class="text-xs text-gray-400">{{ $item['kategori_barang'] }}</p>
                    </div>
                </div>
                <div class="col-span-2 text-center">
                    <p class="text-sm font-medium text-gray-700">Rp {{ number_format($hargaSatuan, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400">/{{ $kategori }}</p>
                </div>
                <div class="col-span-2 flex items-center justify-center gap-1">
                    <button wire:click="ubahQty('{{ $kodeBarang }}', -1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">−</button>
                    <span class="w-7 text-center text-sm font-medium text-gray-800">{{ $item['qty'] }}</span>
                    <button wire:click="ubahQty('{{ $kodeBarang }}', 1)" class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 font-bold transition text-sm">+</button>
                </div>
                <div class="col-span-1 text-center">
                    <span class="text-xs font-medium text-gray-600">{{ $this->durasi }} {{ $kategori === 'jam' ? 'Jam' : 'Hari' }}</span>
                </div>
                <div class="col-span-1 text-center">
                    <p class="text-sm font-semibold text-emerald-700">Rp {{ number_format($subtotalItem, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-1 flex justify-center">
                    <button wire:click="hapusItem('{{ $kodeBarang }}')" wire:confirm="Hapus barang ini dari keranjang?" class="w-7 h-7 flex items-center justify-center bg-red-50 hover:bg-red-100 rounded-lg text-red-500 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/>
                        </svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-400 text-sm">
                Keranjang belanja masih kosong.
            </div>
        @endforelse

            </div>
        </div>

        {{-- Footer Tabel --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-3 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center gap-2">
                <input type="checkbox" id="pilihSemuaBottom" wire:model.live="pilihSemua"
                    @checked($pilihSemua)
                    class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                <label for="pilihSemuaBottom" class="text-sm font-medium text-gray-600 cursor-pointer">
                    Pilih Semua Barang
                </label>
            </div>
            <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4 sm:gap-6">
                    <div class="text-right">
                    <p class="text-xs text-gray-400">Total ({{ count($selectedItems) }} Produk)</p>
                    <p class="text-sm font-bold text-emerald-700">Rp {{ number_format($this->grandTotal, 0, ',', '.') }}</p>
                </div>
                <button wire:click="checkout" @if(count($selectedItems) === 0 || $this->durasi <= 0) disabled @endif class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-emerald-700 hover:bg-emerald-800 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Checkout
                </button>
            </div>
        </div>

    </div>

    {{-- Tombol Kembali --}}
    <div class="pt-1">
        <a href="{{ route('penjualan.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
    </div>

</div>