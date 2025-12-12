<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // $this->customer->id mengambil ID dari URL route binding
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $this->customer->id,
            'address' => 'required|string',
        ];
    }
}
