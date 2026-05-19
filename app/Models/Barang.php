<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $fillable = [
        'gambar_barang',
        'nama_barang',
        'kategori_barang',
        'subkategori_barang',
        'deskripsi_barang',
        'stok_barang',
        'harga_perhari',
        'harga_perjam',
        'catatan_kondisi_barang',
        'status_barang',
    ];
    
    public $timestamps = false;
}
