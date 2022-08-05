<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|min:3|max:12',
            'price' => 'nullable|numeric',
            'eid' => 'nullable|int'
        ];
    }
}
