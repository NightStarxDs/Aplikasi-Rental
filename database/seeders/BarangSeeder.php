<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure the target directory exists in storage/app/public/barang
        if (!Storage::disk('public')->exists('barang')) {
            Storage::disk('public')->makeDirectory('barang');
        }

        // The Factory now handles assigning the correct photo based on the subcategory!
        // Just make sure you placed: 
        // 1. camera.jpg
        // 2. lens.jpg
        // 3. kamera_accessories.jpg
        // 4. tent.jpg
        // 5. camping_gear.jpg
        // inside the storage/app/public/barang/ folder.

        // 2. Create 30 dummy barang records
        Barang::factory(30)->create();
    }
}
