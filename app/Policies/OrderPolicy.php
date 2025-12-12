<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Super Admin Bypassing
     * "Super Admin: All -> return true"
     */
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
        // Manager, Finance, Staff boleh melihat (sesuai permission dasar)
        return $user->hasAnyRole(['Manager', 'Finance', 'Staff']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->hasAnyRole(['Manager', 'Finance', 'Staff']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Manager (C)RU, Finance (R)U (Finance biasanya tdk create order di soal ini, tapi cek permission saja)
        return $user->hasRole('Manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        // Manager CR(U), Finance R(U)
        return $user->hasAnyRole(['Manager', 'Finance']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {
        // "Manager: delete() return false", "Finance: delete() return false"
        // Hanya Super Admin yang bisa (sudah di-handle di method 'before')
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
