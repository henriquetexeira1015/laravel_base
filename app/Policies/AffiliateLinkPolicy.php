<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AffiliateLink;
use Illuminate\Auth\Access\Response;

class AffiliateLinkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AffiliateLink $affiliateLink, User $user): Response
    {
        if ($user->role !== 'admin') {
            return Response::deny('Only admin users can do this!');
        }

        return Response::allow();
    }

    public function getMyAffiliateLinks(User $user): Response
    {
        if ($user->role === 'producer') {
            return Response::deny('Producer can\'t do this!');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->role !== 'affiliate') {
            return Response::deny('Only affiliates can do this!');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        return false;
    }
}