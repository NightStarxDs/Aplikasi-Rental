<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Admin No. 1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'pelanggan',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Pelanggan No. 1',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('pelanggan123'),
            'role' => 'pelanggan',
        ]);

        $this->call([
        BarangSeeder::class,
    ]);
    }
}
