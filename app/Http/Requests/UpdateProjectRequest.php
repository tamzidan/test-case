<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'manager_id' => 'required|exists:users,id',
            'staff_ids' => 'array',
            'staff_ids.*' => 'exists:users,id',
        ];
    }
}
