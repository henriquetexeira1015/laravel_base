<?php
namespace App\Services;

use App\Models\User;

class UserServices
{
    public function index()
    {
        $users = User::all();

        if (!$users) {
            return [
                'success' => false,
                'message' => 'None user found',
                'status' => 404
            ];
        }

        return [
            'success' => true,
            'message' => 'Showing all users',
            'status' => 200,
            'data' => [
                'users' => $users
            ],
        ];
    }

    public function store($validatedData)
    {
        $user = User::create($validatedData);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not created',
                'status' => 422
            ];
        }

        return [
            'success' => true,
            'message' => 'User created successfully',
            'status' => 201,
            'data' => [
                'user name' => $user->name,
                'user email' => $user->email,
            ],
        ];
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found',
                'status' => 404
            ];
        }

        return [
            'success' => true,
            'message' => 'Showing the user',
            'status' => 200,
            'data' => [
                'user name' => $user->name,
                'user email' => $user->email,
            ],
        ];
    }

    public function update($validatedData, $user)
    {
        $user->update($validatedData);

        $user->fresh();

        return [
            'success' => true,
            'message' => 'user updated successfully',
            'data' => [
                'user name' => $user->name,
                'user email' => $user->email,
            ],
        ];
    }

    public function destroy($user)
    {
        $user->delete();

        if ($user) {
            return [
                'success' => false,
                'message' => 'User not deleted',
                'status' => 400
            ];
        }

        return [
            'success' => true,
            'message' => 'user deleted successfully',
        ];
    }

}
