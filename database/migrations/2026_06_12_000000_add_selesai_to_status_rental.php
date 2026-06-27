<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "ALTER TABLE `rental` MODIFY COLUMN `status_rental` ENUM('Menunggu Pembayaran', 'Diajukan', 'Disewa', 'Dikembalikan', 'Selesai', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu Pembayaran'"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(
            "ALTER TABLE `rental` MODIFY COLUMN `status_rental` ENUM('Diajukan', 'Disewa', 'Dikembalikan', 'Dibatalkan') NOT NULL DEFAULT 'Diajukan'"
        );
    }
};
