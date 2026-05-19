<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Rental extends Model
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
}
