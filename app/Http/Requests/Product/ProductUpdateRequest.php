<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:products,id'
            ],

            'name' => [
                'nullable',
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
                'nullable',
                'numeric',
                'min:0.01',
                'max:999999.99',
            ],

            'commission_percentage' => [
                'nullable',
                'numeric',
                'between:0,100'
            ]
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => "The product with this ID does not exist"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'messge' => $validator->errors()->first(),
        ], 422));
    }
}