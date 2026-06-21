<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($this->user()->id_user, 'id_user'),
            ],
            'telepon' => ['nullable', 'string', 'regex:/^\+?[0-9]{10,15}$/', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ];
    }
}
