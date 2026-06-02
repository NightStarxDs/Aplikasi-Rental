<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    // ═══════════════════════════════════════════════════
    // INDEX — Tampilkan daftar pengguna + pencarian
    // GET /admin/users
    // ═══════════════════════════════════════════════════
    public function index(Request $request)
    {
        $query = User::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $keyword = trim($request->search);

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // Filter role
        if ($request->filled('role') && in_array($request->role, ['admin', 'user'])) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('id_user')
            ->paginate(10)
            ->withQueryString();

        // Kembali ke halaman kelola user
        return view('Admin.Admin_Kelola_User', compact('users'));
    }

    // ═══════════════════════════════════════════════════
    // CREATE — Form tambah pengguna
    // GET /admin/users/create
    // ═══════════════════════════════════════════════════
    public function create()
    {
        return view('Admin.Admin_Tambah_User');
    }

    // ═══════════════════════════════════════════════════
    // STORE — Simpan pengguna baru
    // POST /admin/users
    // ═══════════════════════════════════════════════════
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'telepon'  => $request->telepon,
            'alamat'   => $request->alamat,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    // ═══════════════════════════════════════════════════
    // EDIT — Form edit pengguna
    // GET /admin/users/{user}/edit
    // ═══════════════════════════════════════════════════
    public function edit(User $user)
    {
        return view('Admin.Admin_Edit_User', compact('user'));
    }

    // ═══════════════════════════════════════════════════
    // UPDATE — Simpan perubahan data pengguna
    // PUT /admin/users/{user}
    // ═══════════════════════════════════════════════════
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
            'role'    => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // ═══════════════════════════════════════════════════
    // DESTROY — Hapus pengguna
    // DELETE /admin/users/{user}
    // ═══════════════════════════════════════════════════
    public function destroy(User $user)
    {
        // Cegah admin menghapus akun sendiri
        if ($user->id_user === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }


}