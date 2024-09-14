<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->insert([
          ['title'=>'Super Admin'],
          ['title'=>'Patient'],
          ['title'=>"Doctor"]
        ]);

        $admin_roles=Role::query()->where('title','Super Admin')->first();
        $admin_roles->permissions()->attach(Permission::all());


        $patient_roles=Role::query()->where("title",'Patient')->first();
        $Pat_permissions=Permission::query()->whereIn('title',[
            'read_user',
            'create_appointment',
            'read_appointment',
            'update_appointment_patient',
            'delete_appointment_user',
            'index_appointment'
        ])->get();
        $patient_roles->permissions()->attach($Pat_permissions);


        $doctor_role=Role::query()->where("title","Doctor")->first();
        $doc_permissions=Permission::query()->whereIn('title',[
            'read_user',
            'create_appointment',
            'read_appointment',
            'update_appointment_doctor',
            'index_appointment',
            'delete_appointment_user',
            'create_working_hour',
            'doctor_update_working_hour',
            'delete_working_hour',
        ])->get();
        $doctor_role->permissions()->attach($doc_permissions);
    }
}
