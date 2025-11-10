<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3'
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99',
            ],

            'commission_percentage' => [
                'required',
                'numeric',
                'between:0,100'
            ]
        ];
    }
}