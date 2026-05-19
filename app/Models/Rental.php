<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'status_transaksi',
    ];
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

}
