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
        Schema::create('detail_rental', function (Blueprint $table) {
            $table->id('kode_detail');
            $table->foreignId('kode_rental')->constrained('rental', 'kode_rental')->onDelete('cascade');
            $table->foreignId('kode_barang')->constrained('barang', 'kode_barang')->onDelete('cascade');
            $table->integer('jumlah_barang');
            $table->text('catatan_kondisi')->nullable();
            $table->decimal('denda_keterlambatan', 15, 2)->nullable();
            $table->decimal('denda_kerusakan', 15, 2)->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->enum('status_detail', ['Menunggu', 'Lunas'])->default('Menunggu');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rental');
    }
};
