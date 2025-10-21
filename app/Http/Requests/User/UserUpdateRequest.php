<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
            [
                'name' => [
                    'nullable',
                    'string',
                    'max:255'
                ],

                'email' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:6'
                ],
            ];
    }
}
