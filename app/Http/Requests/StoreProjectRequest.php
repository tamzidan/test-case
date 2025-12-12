<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Kita return true, karena otorisasi role sudah ditangani di Controller/Policy
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'manager_id' => 'required|exists:users,id',
            'staff_ids' => 'array',         // Validasi array input untuk sync staff
            'staff_ids.*' => 'exists:users,id',
        ];
    }
}
