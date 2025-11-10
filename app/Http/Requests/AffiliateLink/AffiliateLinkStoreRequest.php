<?php

namespace App\Http\Requests\AffiliateLink;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AffiliateLinkStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product ID for the affiliate program must be provided',

            'product_id.integer' => 'The product ID must be an integer',

            'product_id.exists' => 'Product ID doesn\'t exists in products table',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ]));
    }
}