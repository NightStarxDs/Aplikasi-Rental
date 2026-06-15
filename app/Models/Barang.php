<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

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

    const SUBKATEGORI = [
        'Kamera' => ['DSLR Cam', 'Mirrorless Cam', 'Video Cam', 'Action Cam', 'Lensa', 'Aksesoris Kamera', 'Lighting', 'Audio'],
        'Alat Camping' => ['Tenda', 'Peralatan Tidur', 'Peralatan Memasak', 'Penerangan', 'Power'],
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
        if (! is_array($gambar) || empty($gambar)) { return null; }
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

    public function cekKetersediaan(): bool
    {
        return $this->stok > 0;
    }

    /**
     * Sinkronkan status_barang berdasarkan stok saat ini, lalu simpan ke DB.
     * Gunakan method ini setiap kali stok berubah.
     */
    public function syncStatus(): void
    {
        $stok = (int) $this->stok;

        if ($stok <= 0) {
            $this->stok = 0; // pastikan tidak negatif
            $this->status_barang = 'Tidak Tersedia';
        } elseif ($stok <= 5) {
            $this->status_barang = 'Sedikit';
        } else {
            $this->status_barang = 'Tersedia';
        }

        $this->save();
    }
}