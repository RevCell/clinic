<?php

namespace App\Providers;

use App\Http\Requests\AppointmentPatientRequest;
use App\Models\User;
use App\Policies\AppointmentPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\RolePolicy;
use App\Policies\Userpolicy;
use App\Policies\WorkingDaysPolicy;
use App\Policies\WorkingHoursPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //USER MANAGEMENT--------------------------
        Gate::define("create_user",[Userpolicy::class,'create']);
        Gate::define("read_user",[Userpolicy::class,'view']);
        Gate::define("update_user",[Userpolicy::class,'update']);
        Gate::define("delete_user",[Userpolicy::class,'delete']);
        Gate::define("index_user",[Userpolicy::class,'index']);
        //ROLE MANAGEMENT--------------------------
        Gate::define("index_role",[RolePolicy::class,'index']);
        Gate::define("read_role",[RolePolicy::class,'view']);
        Gate::define("create_role",[RolePolicy::class,'create']);
        Gate::define("update_role",[RolePolicy::class,'update']);
        Gate::define("delete_role",[RolePolicy::class,'delete']);
        //DEPARTMENT MANAGEMENT---------------------
        Gate::define("create_department",[DepartmentPolicy::class,'create']);
        Gate::define("update_department",[DepartmentPolicy::class,'update']);
        Gate::define("delete_department",[DepartmentPolicy::class,'delete']);
        //DOCTORS-----------------------------------
        Gate::define("create_doctor",[DoctorPolicy::class,'create']);
        Gate::define("read_doctor",[DoctorPolicy::class,'view']);
        Gate::define("update_doctor",[DoctorPolicy::class,'update']);
        Gate::define("delete_doctor",[DoctorPolicy::class,"delete"]);
        Gate::define("index_doctor",[DoctorPolicy::class,'index']);
        //DaysOfWeek--------------------------------
        Gate::define("create_wd",[WorkingDaysPolicy::class,'create']);
        Gate::define("update_wd",[WorkingDaysPolicy::class,'update']);
        Gate::define("delete_wd",[WorkingDaysPolicy::class,'delete']);
        //WorkingHours------------------------------
        Gate::define("create_working_hour",[WorkingHoursPolicy::class,'create']);
        Gate::define("doctor_update_working_hour",[WorkingHoursPolicy::class,'update_doctor']);
        Gate::define("admin_update_working_hour",[WorkingHoursPolicy::class,'update_admin']);
        Gate::define("delete_working_hour",[WorkingHoursPolicy::class,'delete']);
        //Doctor'sAppointment-----------------------
        Gate::define("create_appointment",[AppointmentPolicy::class,'create']);
        Gate::define("index_appointment",[AppointmentPolicy::class,'index']);
        Gate::define("read_appointment",[AppointmentPolicy::class,'view']);
        Gate::define("update_appointment_patient",[AppointmentPolicy::class,'update_patient']);
        Gate::define("update_appointment_doctor",[AppointmentPolicy::class,'update_doctor']);
        Gate::define("delete_appointment_user",[AppointmentPolicy::class,'delete_user']);
        Gate::define("delete_appointment_admin",[AppointmentPolicy::class,'delete_admin']);
    }
}
