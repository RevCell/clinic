<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkingHours;
use Illuminate\Auth\Access\Response;

class WorkingHoursPolicy
{
    public function create(User $user): bool
    {
        return $user->role->permission_check("create_working_hour");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update_doctor(User $user, WorkingHours $workingHours): bool
    {
        return $user->role->permission_check("doctor_update_working_hour") && !empty($workingHours);
    }

    public function update_admin(User $user, WorkingHours $workingHours): bool
    {
        return $user->role->permission_check("admin_update_working_hour") && !empty($workingHours);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorkingHours $workingHours): bool
    {
        return $user->role->permission_check("delete_working_hour") && !empty($workingHours);
    }

}
