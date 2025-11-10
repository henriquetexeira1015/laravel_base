<?php

namespace App\Http\Requests\User;

use App\Enums\RoleEnum;
use Illuminate\Validation\Rules\Enum;
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
                'id' => [
                    'integer',
                    'exists:users,id',
                    'nullable',
                ],

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

                'role' => [
                    'nullable',
                    new Enum(RoleEnum::class),
                ],

                'password' => [
                    'required',
                    'string',
                    'min:6'
                ],
            ];
    }
}
