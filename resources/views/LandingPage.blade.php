<x-app2-layout>
    <section class="h-full w-full flex flex-col items-center mt-[73px] bg-gray-100 pb-10">
        
        <div class="relative w-[1470px] h-[570px]">
            <img src="{{ asset('images/Gambar-Gunung.jpg') }}" alt="Gunung" class="w-full h-full object-cover rounded-lg">
            <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg"></div>
            
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                <h1 class="text-6xl font-bold">Selamat Datang di <span class="text-green-600">Out</span>Rent</h1>
                <p class="text-2xl mt-4">Solusi sewa alat camping dan kamera termudah.</p>
                
                <div class="inline-flex items-center gap-10 mt-5">
                    <x-primary-button>Belanja Sekarang</x-primary-button>
                    <x-primary-button>Lihat Katalog</x-primary-button>
                </div>
            </div>

            <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2 w-screen bg-emerald-900 h-[70px] flex items-center overflow-hidden">
                <div class="animate-marquee whitespace-nowrap flex text-white text-xl font-medium">
                    <span class="mx-10">Promo Sewa Kamera Diskon 20%!</span>
                    <span class="mx-10">Tenda Dome Ready untuk Akhir Pekan!</span>
                    <span class="mx-10">Lensa Mirrorless Terbaru Tersedia!</span>
                    <span class="mx-10">Promo Sewa Kamera Diskon 20%!</span>
                    <span class="mx-10">Tenda Dome Ready untuk Akhir Pekan!</span>
                </div>
            </div>
        </div>
        
    </section>

    <section class="h-full w-full flex flex-col items-center bg-gray-100 pb-10">
        <div></div>
    </section>
</x-app2-layout>