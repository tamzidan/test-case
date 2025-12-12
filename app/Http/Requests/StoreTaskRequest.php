<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Otorisasi sudah di-handle Policy/Controller
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id'  => 'required|exists:projects,id',
            'status'      => 'required|in:pending,in_progress,completed',

            'assigned_to_user_id' => 'nullable|exists:users,id',
        ];
    }
}
