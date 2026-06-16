<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OutRent') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-gray-200 font-sans antialiased">
    @include('layouts.navigation3')

    <main class="pt-[70px] pb-16">
        {{ $slot }}
    </main>

    @if(isset($cancelledRentals) && count($cancelledRentals) > 0)
        <!-- Modal Notifikasi Transaksi Dibatalkan -->
        <div id="cancellation-notify-modal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 md:p-8 border border-gray-100">
                <!-- Close Button -->
                <button onclick="closeCancellationModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Warning Header -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-red-50 text-red-600 mb-3 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Transaksi Dibatalkan</h2>
                    <p class="text-xs text-gray-500 mt-1">Admin telah membatalkan transaksi sewa Anda.</p>
                </div>

                <!-- List of Cancelled Rentals -->
                <div class="space-y-3 max-h-48 overflow-y-auto mb-6 pr-1">
                    @foreach($cancelledRentals as $rental)
                        <div class="bg-red-50/50 border border-red-100 rounded-xl p-4 flex flex-col gap-1 text-left">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-red-800 font-mono tracking-wider bg-red-100/50 px-2 py-0.5 rounded">{{ $rental->kode_rental }}</span>
                                <span class="text-[10px] text-gray-400 font-medium">Batal</span>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">
                                Tanggal Sewa: <strong class="text-gray-800">{{ \Carbon\Carbon::parse($rental->waktu_sewa)->format('d M Y') }}</strong>
                            </p>
                            <p class="text-xs text-gray-600">
                                Total Refund: <strong class="text-emerald-700 font-semibold">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</strong>
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Alert Info -->
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-3 text-[11px] text-amber-800 mb-6 leading-relaxed text-left">
                    <strong>Informasi Pengembalian Dana:</strong> Proses pengembalian dana (refund) akan diproses oleh tim kami paling lambat 3x24 Jam ke metode pembayaran Anda.
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-2">
                    <a href="{{ route('users.history') }}" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl font-bold transition shadow-md text-sm">
                        Lihat Riwayat Transaksi
                    </a>
                    <button onclick="closeCancellationModal()" class="w-full flex items-center justify-center px-5 py-2 text-xs font-semibold text-gray-500 hover:text-gray-700 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
        <script>
            function closeCancellationModal() {
                const modal = document.getElementById('cancellation-notify-modal');
                if (modal) {
                    modal.style.display = 'none';
                }
            }
            // Close when clicking outside the modal content
            document.getElementById('cancellation-notify-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCancellationModal();
                }
            });
        </script>
    @endif

    @livewireScripts
</body>

<div id="small-footer" class="fixed bottom-0 left-0 w-full bg-white border-t border-emerald-100 py-3 text-sm z-40 transition-transform duration-500 translate-y-0 shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-between items-center px-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <span class="font-bold text-gray-900 inline-flex items-center"><img src="{{ asset('images/OutRent-Logo.png') }}" alt="Logo" class="h-[1.8em] w-auto mr-2"><span class="text-emerald-600">Out</span>Rent</span>
                <span class="hidden sm:inline text-gray-400">|</span>
                <span class="hidden sm:inline text-gray-600">Sewa Alat Camping & Kamera</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-500 hidden md:inline">Copyright &copy; 2025</span>
            </div>
        </div>
    </div>
</html>