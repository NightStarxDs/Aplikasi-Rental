<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\PerhitunganDenda;

class Detail_Rental extends Model implements PerhitunganDenda
{
    protected $table = 'detail_rental';
    protected $primaryKey = 'kode_detail';
    protected $fillable = [
        'kode_rental',
        'kode_barang',
        'jumlah_barang',
        'catatan_kondisi',
        'denda_keterlambatan',
        'denda_kerusakan',
        'subtotal',
        'status_detail',
    ];
    
    public $timestamps = false;

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'kode_rental', 'kode_rental');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    protected function calculateLateFee(int $lateUnits, float $basePrice): float
    {
        return round($lateUnits * $basePrice * 1.5, 2);
    }

    public function hitungDenda_Keterlambatan(): float
    {
        return (float) ($this->denda_keterlambatan ?? 0);
    }

    public function hitungDendaKeterlambatan(Carbon $actualReturn): float
    {
        $rental = $this->rental;
        if (! $rental || ! $rental->waktu_kembali || ! $this->barang) {
            return 0.0;
        }

        $deadline = Carbon::parse($rental->waktu_kembali);
        if ($actualReturn->lessThanOrEqualTo($deadline)) {
            return 0.0;
        }

        $isDaily = $rental->isDailyRental();
        $secondsLate = $deadline->diffInSeconds($actualReturn, false);
        $unitSeconds = $isDaily ? 86400 : 3600;
        $lateUnits = max(1, (int) ceil($secondsLate / $unitSeconds));
        $basePrice = $isDaily ? (float) $this->barang->harga_perhari : (float) $this->barang->harga_perjam;

        return round($lateUnits * $basePrice * 1.5 * $this->jumlah_barang, 2);
    }

    public function hitungDenda_Kerusakan(): float
    {
        return (float) ($this->denda_kerusakan ?? 0);
    }
}