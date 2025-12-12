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
            'project_id' => 'required|exists:projects,id',
            'assigned_to_user_id' => 'nullable|exists:users,id', // Boleh null jika belum ada yang mengerjakan
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed', // Sesuaikan dengan enum/string di database
        ];
    }
}
