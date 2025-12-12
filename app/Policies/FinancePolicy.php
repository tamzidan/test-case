<?php

namespace App\Policies;

use App\Models\Finance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FinancePolicy
{
    public function before(User $user, $ability)
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-finance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Finance $finance): bool
    {
        return $user->hasPermissionTo('view-finance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-finance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Finance $finance): bool
    {
        return $user->hasPermissionTo('edit-finance');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Finance $finance): bool
    {
        return $user->hasPermissionTo('delete-finance');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Finance $finance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Finance $finance): bool
    {
        return false;
    }
}
