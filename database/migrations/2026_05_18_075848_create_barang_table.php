<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('kode_barang');
            $table->string('gambar_barang');
            $table->string('nama_barang', 100);
            $table->enum('kategori_barang', ['Kamera', 'Alat Camping']);
            $table->text('deskripsi_barang')->nullable();
            $table->integer('stok');
            $table->decimal('harga_perhari', 15, 2);
            $table->decimal('harga_perjam', 15, 2);
            $table->text('catatan_kondisi_barang')->nullable();
            $table->enum('status_barang', ['Tersedia', 'Sedikit', 'Tidak Tersedia'])->default('Tersedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
