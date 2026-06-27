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
        Schema::table('rental', function (Blueprint $table) {
            $table->enum('metode_pembayaran', ['Midtrans', 'QRIS', 'Transfer Bank', 'COD'])->nullable()->after('total_denda');
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'bukti_pembayaran']);
        });
    }
};
