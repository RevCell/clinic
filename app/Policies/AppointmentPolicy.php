<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->role->permission_check("index_appointment");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->role->permission_check("read_appointment") && !empty($appointment);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permission_check("create_appointment");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update_patient(User $user, Appointment $appointment): bool
    {
        return $user->role->permission_check("update_appointment_patient") && !empty($appointment);
    }

    public function update_doctor(User $user, Appointment $appointment): bool
    {
        return $user->role->permission_check("update_appointment_doctor") && !empty($appointment);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete_user(User $user, Appointment $appointment): bool
    {
        return $user->role->permission_check("delete_appointment_user") && !empty($appointment);
    }
    public function delete_admin(User $user, Appointment $appointment): bool
    {
        return $user->role->permission_check("delete_appointment_admin") && !empty($appointment);
    }
}
