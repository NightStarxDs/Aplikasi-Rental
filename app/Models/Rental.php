<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailRental;

class Rental extends Model
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
        'status',
    ];

    protected $casts = [
        'waktu_sewa'           => 'datetime',
        'waktu_kembali'        => 'datetime',
        'waktu_kembali_aktual' => 'datetime',
        'total_harga'          => 'decimal:2',
        'total_denda'          => 'decimal:2',
    ];
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke DetailRental
     * Sesuaikan nama model dan foreign key dengan project Anda
     */
    public function detailRentals()
    {
        return $this->hasMany(Detail_Rental::class, 'kode_rental', 'kode_rental');
    }

}
