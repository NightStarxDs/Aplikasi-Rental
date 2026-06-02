<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        // Ambil id_user dari route parameter
        $userId = $this->route('user')->id_user;

        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                'max:255',
                // Abaikan email milik user yang sedang diedit
                Rule::unique('users', 'email')->ignore($userId, 'id_user'),
            ],
            'telepon'  => ['nullable', 'string', 'max:20'],
            'alamat'   => ['nullable', 'string', 'max:500'],
            'role'     => ['required', 'in:admin,user'],
            // Password opsional saat update
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah digunakan pengguna lain.',
            'role.required'      => 'Role wajib dipilih.',
            'role.in'            => 'Role harus admin atau user.',
            'password.min'       => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ];
    }
}