<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    public function definition(): array
    {
        // Define random categories and subcategories
        $isKamera = $this->faker->boolean();
        $kategori = $isKamera ? 'Kamera' : 'Alat Camping';
        $subkategoris = $isKamera 
            ? ['DSLR Cam', 'Mirrorless Cam', 'Video Cam', 'Action Cam', 'Lensa', 'Aksesoris Kamera', 'Lighting', 'Audio']
            : ['Tenda', 'Peralatan Tidur', 'Peralatan Memasak', 'Penerangan', 'Power'];
            
        $subkategori = $this->faker->randomElement($subkategoris);

        // Map subcategories to specific dummy photos
        // You will need to place these 5 files in storage/app/public/barang/
        if (in_array($subkategori, ['DSLR Cam', 'Mirrorless Cam', 'Video Cam', 'Action Cam'])) {
            $foto = 'barang/camera.jpg';
        } elseif ($subkategori === 'Lensa') {
            $foto = 'barang/lens.jpg';
        } elseif ($kategori === 'Kamera') {
            $foto = 'barang/kamera_accessories.jpg'; // Lighting, Audio, Aksesoris
        } elseif ($subkategori === 'Tenda') {
            $foto = 'barang/tent.jpg';
        } else {
            $foto = 'barang/camping_gear.jpg'; // Peralatan Tidur, Memasak, dll.
        }

        $stok = $this->faker->numberBetween(0, 15);
        $hargaPerHari = $this->faker->numberBetween(50000, 500000);

        return [
            'gambar_barang' => [$foto], // We assign just the 1 default photo based on its subcategory
            'nama_barang' => $this->faker->words(3, true),
            'kategori_barang' => $kategori,
            'subkategori_barang' => $subkategori,
            'deskripsi_barang' => $this->faker->paragraph(),
            'catatan_kondisi_barang' => $this->faker->sentence(),
            'stok' => $stok,
            'harga_perhari' => $hargaPerHari,
            'harga_perjam' => round($hargaPerHari / 24, 2),
            'status_barang' => $stok > 5 ? 'Tersedia' : ($stok > 0 ? 'Sedikit' : 'Tidak Tersedia'),
        ];
    }
}
