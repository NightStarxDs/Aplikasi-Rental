<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya admin yang boleh tambah user
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'telepon'               => ['nullable', 'string', 'max:20'],
            'alamat'                => ['nullable', 'string', 'max:150'],
            'role'                  => ['required', 'in:admin,user'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'                  => 'Nama wajib diisi.',
            'name.max'                       => 'Nama maksimal 255 karakter.',
            'email.required'                 => 'Email wajib diisi.',
            'email.email'                    => 'Format email tidak valid.',
            'email.unique'                   => 'Email ini sudah digunakan.',
            'telepon.max'                    => 'Nomor telepon maksimal 20 karakter.',
            'alamat.max'                     => 'Alamat maksimal 500 karakter.',
            'role.required'                  => 'Role wajib dipilih.',
            'role.in'                        => 'Role harus admin atau user.',
            'password.required'              => 'Password wajib diisi.',
            'password.min'                   => 'Password minimal 8 karakter.',
            'password.confirmed'             => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ];
    }
}