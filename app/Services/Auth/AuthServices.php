<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    public function login($validatedData): array
    {
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return [
                'success' => false,
                'message' => 'Invalid credentials',
                'status' => 422
            ];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'success' => true,
            'message' => 'Logged successfully',
            'status' => 200,
            'data' => [
                'User name' => $user->name,
                'User email' => $user->email,
                'Token' => $token
            ],
        ];
    }

    public function logout()
    {

    }
}