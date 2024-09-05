<?php

namespace App\Policies;

use App\Models\DaysOfWeek;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class WorkingDaysPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DaysOfWeek $daysOfWeek): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,DaysOfWeek $daysOfWeek): bool
    {
        return $user->role->permission_check("create_wd") && !empty($daysOfWeek);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DaysOfWeek $daysOfWeek): bool
    {
        return $user->role->permission_check("update_wd") && !empty($daysOfWeek);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DaysOfWeek $daysOfWeek): bool
    {
        return $user->role->permission_check("delete_wd") && !empty($daysOfWeek);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DaysOfWeek $daysOfWeek): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DaysOfWeek $daysOfWeek): bool
    {
        //
    }
}
