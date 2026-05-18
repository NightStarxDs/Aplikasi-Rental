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
        Schema::create('rental', function (Blueprint $table) {
            $table->id('kode_rental');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->dateTime('waktu_sewa')->nullable();
            $table->dateTime('waktu_kembali')->nullable();
            $table->dateTime('waktu_kembali_aktual')->nullable();
            $table->decimal('total_harga', 15, 2)->nullable();
            $table->decimal('total_denda', 15, 2)->nullable();
            $table->enum('status', ['Diajukan', 'Disewa', 'Dikembalikan ', 'Selesai', 'Dibatalkan'])->default('Diajukan');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental');
    }
};
