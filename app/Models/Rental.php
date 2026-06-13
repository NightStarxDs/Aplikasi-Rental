<?php

namespace App\Models;

use App\Contracts\PerhitunganDenda;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model implements PerhitunganDenda
{
    protected $table = 'rental';
    protected $primaryKey = 'kode_rental';
    protected $fillable = [
        'id_user',
        'waktu_sewa',
        'waktu_kembali',
        'waktu_kembali_aktual',
        'total_harga',
        'total_denda',
        'status_rental',
        'metode_pembayaran',
        'bukti_pembayaran',
        'notifikasi_pembatalan',
    ];

    protected $casts = [
        'waktu_sewa'           => 'datetime',
        'waktu_kembali'        => 'datetime',
        'waktu_kembali_aktual' => 'datetime',
        'total_harga'          => 'decimal:2',
        'total_denda'          => 'decimal:2',
        'notifikasi_pembatalan' => 'boolean',
    ];
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function hitungTotal(): float
    {
        return (float) $this->total_harga;
    }

    /**
     * Relasi ke DetailRental
     * Sesuaikan nama model dan foreign key dengan project Anda
     */
    public function detailRentals()
    {
        return $this->hasMany(Detail_Rental::class, 'kode_rental', 'kode_rental');
    }

    public function isDailyRental(): bool
    {
        return $this->waktu_sewa
            && $this->waktu_kembali
            && $this->waktu_sewa->format('H:i:s') === '00:00:00'
            && $this->waktu_kembali->format('H:i:s') === '23:59:59';
    }

    protected function calculateLateFee(int $lateUnits, float $basePrice): float
    {
        return round($lateUnits * $basePrice * 1.5, 2);
    }

    public function hitungDenda_Keterlambatan(): float
    {
        if (! $this->waktu_kembali_aktual) {
            return 0.0;
        }

        return $this->detailRentals->sum(fn (Detail_Rental $detail) => $detail->hitungDendaKeterlambatan($this->waktu_kembali_aktual));
    }

    public function hitungDenda_Kerusakan(): float
    {
        return $this->detailRentals->sum(fn (Detail_Rental $detail) => $detail->hitungDenda_Kerusakan());
    }

}
