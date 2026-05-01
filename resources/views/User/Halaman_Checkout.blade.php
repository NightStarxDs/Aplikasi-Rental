<x-app3-layout>
    <div class="min-h-screen bg-slate-100/80 p-3 lg:p-4" x-data="{ paymentMethod: 'cod' }">
        <div class="mx-auto max-w-6xl space-y-4">
            <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <h2 class="text-base font-semibold text-slate-900">Detail Penyewa</h2>
                <div class="mt-4 grid grid-cols-1 gap-3 text-xs text-slate-700 sm:text-sm md:grid-cols-3">
                    <p class="rounded-md bg-slate-50 px-3 py-2 break-words">Benjamine Nyetanyahu</p>
                    <p class="rounded-md bg-slate-50 px-3 py-2 break-words md:text-center">+1 9124 1042 19247</p>
                    <p class="rounded-md bg-slate-50 px-3 py-2 break-words md:text-right">BenjamineNyetanyahu@Mail.com</p>
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
                    @foreach (range(1, 3) as $index)
                        <article class="grid grid-cols-1 gap-3 rounded-lg border border-transparent px-2.5 py-3 transition hover:border-emerald-200 hover:bg-emerald-50/40 md:grid-cols-12 md:items-center">
                            <div class="col-span-5 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('images/sonyA7.png') }}" alt="Sleeping Bag" class="w-full h-full object-cover rounded-lg">
                    </div>
                                <div>
                                    <p class="text-xs text-slate-500 md:hidden">Produk</p>
                                    <p class="text-sm font-semibold text-slate-900">Sony A7</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-slate-500 md:hidden">Harga Satuan</p>
                                <p class="text-sm text-slate-700 md:text-center">Rp50.000</p>
                            </div>
                            <div class="col-span-1">
                                <p class="text-xs text-slate-500 md:hidden">Kuantitas</p>
                                <p class="text-sm font-semibold text-slate-800 md:text-center">1</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-slate-500 md:hidden">Durasi Penyewaan</p>
                                <p class="text-sm font-semibold text-slate-800 md:text-center">3 Jam</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-slate-500 md:hidden">Subtotal</p>
                                <p class="text-sm font-semibold text-slate-900 md:text-right">Rp50.000</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <div class="space-y-3">
                        <h3 class="text-base font-semibold text-slate-900">Metode Pembayaran</h3>
                        <div class="flex flex-wrap gap-3">
                            <button
                                type="button"
                                @click="paymentMethod = 'cod'"
                                :class="paymentMethod === 'cod' ? 'border-emerald-600 bg-emerald-50 text-emerald-700 shadow-sm' : 'border-slate-300 bg-white text-slate-600 hover:border-emerald-300 hover:text-emerald-700'"
                                class="rounded-lg border px-4 py-1.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-emerald-500/60">
                                COD
                            </button>
                            <button
                                type="button"
                                @click="paymentMethod = 'transfer'"
                                :class="paymentMethod === 'transfer' ? 'border-emerald-600 bg-emerald-50 text-emerald-700 shadow-sm' : 'border-slate-300 bg-white text-slate-600 hover:border-emerald-300 hover:text-emerald-700'"
                                class="rounded-lg border px-4 py-1.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-emerald-500/60">
                                Transfer Bank
                            </button>
                            <button
                                type="button"
                                @click="paymentMethod = 'card'"
                                :class="paymentMethod === 'card' ? 'border-emerald-600 bg-emerald-50 text-emerald-700 shadow-sm' : 'border-slate-300 bg-white text-slate-600 hover:border-emerald-300 hover:text-emerald-700'"
                                class="rounded-lg border px-4 py-1.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-emerald-500/60">
                                Kartu Kredit/Debit
                            </button>
                        </div>
                    </div>

                    <div class="w-full max-w-sm space-y-3 rounded-lg bg-slate-50 p-3.5">
                        <div class="flex items-center justify-between text-sm text-slate-700">
                            <p>Subtotal Pesanan</p>
                            <p class="font-semibold text-slate-900">Rp50.000</p>
                        </div>
                        <div class="border-t border-slate-200 pt-3">
                            <div class="flex items-center justify-between text-xl font-semibold text-slate-900">
                                <p>Total Pembayaran</p>
                                <p class="text-emerald-700">Rp50.000</p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="button" class="min-w-40 rounded-lg items-end bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/70 active:scale-[0.98]">
                        Checkout
                    </button>
                </div>
            </section>
            <a href="{{ route('Keranjang') }}"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-800">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                            Kembali
                        </a>
        </div>
    </div>
</x-app3-layout>