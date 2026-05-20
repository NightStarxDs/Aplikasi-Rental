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
        'stok',
        'harga_perhari',
        'harga_perjam',
        'catatan_kondisi_barang',
        'status_barang',
    ];

    protected $casts = [
        'gambar_barang' => 'array',
        'harga_perhari' => 'decimal:2',
        'harga_perjam' => 'decimal:2',
    ];

    public $timestamps = false;

    public function fotoUtama(): ?string
    {
        $gambar = $this->gambar_barang;

        if (! is_array($gambar) || empty($gambar)) {
            return null;
        }

        return $gambar[0];
    }

    public function fotoUtamaUrl(): ?string
    {
        $foto = $this->fotoUtama();

        return $foto ? asset('storage/' . $foto) : null;
    }

    public function labelKategori(): string
    {
        return $this->kategori_barang === 'Alat Camping' ? 'Camping' : $this->kategori_barang;
    }
}
