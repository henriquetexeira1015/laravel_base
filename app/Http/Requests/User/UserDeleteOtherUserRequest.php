<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserDeleteOtherUserRequest extends FormRequest
{
    public function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
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
                'exists:users,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'You must provide the ID in the URL to access this service! Example: /...other-user/1',

            'id.integer' => 'The ID must be an integer number',

            'id.exists' => 'The user with this ID does not exist',
        ];
    }
}
