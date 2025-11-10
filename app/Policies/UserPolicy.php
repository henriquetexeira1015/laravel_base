<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->role !== 'admin') {
            return Response::denyWithStatus(403, 'Only admin users can do this!');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $requestUser, User $model): Response
    {
        if ($requestUser->role !== 'admin') {
            return Response::deny('Only admin users can do this!');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    public function updateOtherUser(User $requestUser): Response
    {
        if ($requestUser->role !== 'admin') {
            return Response::deny('Only admin users can update other user\'s data!');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return true;
    }

    public function deleteOtherUser(User $requestUser, User $deletingUser): Response
    {
        if ($requestUser->role !== 'admin') {
            return Response::deny('Only admin users can delete another users!');
        }

        if ($deletingUser->role === 'admin') {
            return Response::deny('You can\'t delete a admin');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
