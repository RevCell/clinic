<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
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
    public function view(User $user, Department $department): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permission_check("create_department");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Department $selected_user): bool
    {
        return $user->role->permission_check("update_department") && !empty($selected_user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Department $selected_user): bool
    {
        return $user->role->permission_check("delete_department") && !empty($selected_user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Department $department): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Department $department): bool
    {
        //
    }
}
