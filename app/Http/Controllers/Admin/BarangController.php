<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderByDesc('kode_barang')->get();

        return view('Admin.Admin_Inventaris_Barang', compact('barangs'));
    }

    public function create()
    {
        return view('Admin.Admin_Tambah_Barang');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['required', 'in:kamera,camping'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
            'subkategori' => ['required', 'string'],
            'catatan_kondisi_barang' => ['nullable', 'string'],
            'foto_1' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_2' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_3' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_4' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_5' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'foto_1.required' => 'Foto utama wajib diunggah.',
            'foto_1.image' => 'Foto utama harus berupa gambar.',
        ]);

        $gambar = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("foto_$i")) {
                $gambar[] = $request->file("foto_$i")->store('barang', 'public');
            }
        }

        $stok = (int) $validated['jumlah'];
        $hargaPerHari = (float) $validated['harga'];

        Barang::create([
            'gambar_barang' => $gambar,
            'nama_barang' => $validated['nama_barang'],
            'kategori_barang' => $validated['kategori'] === 'kamera' ? 'Kamera' : 'Alat Camping',
            'subkategori_barang' => $validated['subkategori'],
            'catatan_kondisi_barang'    => $validated['catatan_kondisi_barang'] ?? null,
            'deskripsi_barang' => $validated['deskripsi'],
            'stok' => $stok,
            'harga_perhari' => $hargaPerHari,
            'harga_perjam' => round($hargaPerHari / 24, 2),
            'status_barang' => $this->resolveStatus($stok),
        ]);

        $subkategoriValid = $validated['kategori'] === 'kamera'
        ? ['DSLR Cam', 'Mirrorless Cam', 'Video Cam', 'Action Cam', 'Lensa', 'Aksesoris Kamera', 'Lighting', 'Audio']
        : ['Tenda', 'Peralatan Tidur', 'Peralatan Memasak', 'Penerangan', 'Power'];

        return redirect()
            ->route('Inventaris')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('Admin.Admin_Edit_Barang', compact('barang'));
    }

    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'     => ['required', 'string', 'max:100'],
            'deskripsi'       => ['nullable', 'string'],
            'kategori'        => ['required', 'in:kamera,camping'],
            'subkategori'     => ['required', 'string'],      
            'jumlah'          => ['required', 'integer', 'min:0'],
            'harga'           => ['required', 'numeric', 'min:0'],
            'catatan_kondisi_barang' => ['nullable', 'string'],      
            'foto_1'          => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_2'          => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_3'          => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_4'          => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_5'          => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori.required'    => 'Kategori wajib dipilih.',
            'subkategori.required' => 'Subkategori wajib dipilih.',
            'jumlah.required'      => 'Jumlah barang wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
        ]);

        // Validasi subkategori sesuai kategori yang dipilih
        $subkategoriValid = $validated['kategori'] === 'kamera'
            ? ['DSLR Cam','Mirrorless Cam','Video Cam','Action Cam','Lensa','Aksesoris Kamera','Lighting','Audio']
            : ['Tenda','Peralatan Tidur','Peralatan Memasak','Penerangan','Power'];

        if (! in_array($validated['subkategori'], $subkategoriValid)) {
            return back()->withInput()->withErrors(['subkategori' => 'Subkategori tidak valid untuk kategori yang dipilih.']);
        }

        // Handle foto
        $gambar = array_values($barang->gambar_barang ?? []);
        $gambar = array_pad($gambar, 5, null);

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("foto_$i")) {
                $index = $i - 1;
                if (! empty($gambar[$index])) {
                    Storage::disk('public')->delete($gambar[$index]);
                }
                $gambar[$index] = $request->file("foto_$i")->store('barang', 'public');
            }
        }

        $gambar = array_values(array_filter($gambar));

        if (empty($gambar)) {
            return back()->withInput()->withErrors(['foto_1' => 'Minimal satu foto barang harus tersedia.']);
        }

        $stok        = (int) $validated['jumlah'];
        $hargaPerHari = (float) $validated['harga'];

        $barang->update([
            'gambar_barang'      => $gambar,
            'nama_barang'        => $validated['nama_barang'],
            'kategori_barang'    => $validated['kategori'] === 'kamera' ? 'Kamera' : 'Alat Camping',
            'subkategori_barang' => $validated['subkategori'],           // ← dari input user
            'deskripsi_barang'   => $validated['deskripsi'],
            'catatan_kondisi_barang'    => $validated['catatan_kondisi_barang'] ?? null, // ← tambah
            'stok'               => $stok,
            'harga_perhari'      => $hargaPerHari,
            'harga_perjam'       => round($hargaPerHari / 24, 2),
            'status_barang'      => $this->resolveStatus($stok),
        ]);

        return redirect()
            ->route('Detail_Barang', $barang->kode_barang)
            ->with('success', 'Barang berhasil diperbarui.');
    }
    public function Hapus_Barang()
    {
        return view('Admin.Admin_Inventaris_Barang');
    }

    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('Admin.Admin_Detail_Barang', compact('barang'));
    }

    private function resolveStatus(int $stok): string
    {
        if ($stok <= 0) {
            return 'Tidak Tersedia';
        }

        if ($stok <= 5) {
            return 'Sedikit';
        }

        return 'Tersedia';
    }

    public function destroy($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

        $barang->delete();

        return redirect()->route('Inventaris')
                        ->with('success', 'Barang berhasil dihapus');
}
}
