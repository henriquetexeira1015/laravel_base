<?php
namespace App\Services\User;

use App\Models\User;

class UserServices
{
    public function index(): array
    {
        $users = User::all();

        return [
            'success' => true,
            'message' => 'Showing all users',
            'status' => 200,
            'data' => [
                'Users' => $users
            ],
        ];
    }

    public function store($validatedData): array
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
                'User name' => $user->name,
                'User email' => $user->email,
                'User role' => $user->role,
            ],
        ];
    }

    public function show($validatedData): array
    {
        $user = User::where('id', $validatedData['id'])->first();

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
                'User name' => $user->name,
                'User email' => $user->email,
                'User role' => $user->role,
            ],
        ];
    }

    public function update($validatedData, $user): array
    {

        $user->update($validatedData);

        $user->fresh();

        return [
            'success' => true,
            'message' => 'user updated successfully',
            'data' => [
                'User name' => $user->name,
                'User email' => $user->email,
                'User role' => $user->role,
            ],
        ];
    }

    public function updateOtherUser($validatedData, $updatingUser)
    {
        $updatingUser->update($validatedData);

        $updatingUser->fresh();

        return [
            'success' => true,
            'message' => 'User updated successfully',
            'status' => 200,
            'data' => [
                'User name' => $updatingUser->name,
                'User email' => $updatingUser->email,
                'User role' => $updatingUser->role,
            ],
        ];
    }

    public function destroy($user): array
    {
        $user->delete();

        $user = User::where('id', $user->id)->first();

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

    public function destroyOtherUser($deletingUser): array
    {
        $deletingUser->delete();


        $deletingUser = User::where('id', $deletingUser->id)->first();

        if ($deletingUser) {
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