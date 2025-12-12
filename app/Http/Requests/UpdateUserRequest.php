<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // $this->user->id mengambil ID user yang sedang diedit dari route
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'role' => 'required|exists:roles,name',
            'password' => 'nullable|string|min:8', // Nullable karena mungkin tidak ganti password
        ];
    }
}
