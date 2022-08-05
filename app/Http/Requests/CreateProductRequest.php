<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:12',
            'categoriesEid' => 'nullable|array',
            'categoriesEid.*' => 'nullable|exists:categories,id',
            'price' => 'required|numeric',
            'eid' => 'nullable|int'
        ];
    }
}
