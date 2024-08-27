<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->role->permission_check("index_role");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $selected_role): bool
    {
        return $user->role->permission_check("read_role") && !empty($selected_role);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permission_check("create_role");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $selected_role): bool
    {
        return $user->role->permission_check("update_role") && !empty($selected_role);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $selected_role): bool
    {
        return $user->role->permission_check("delete_role") && !empty($selected_role);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        //
    }
}
