<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->insert([
           //---------Departments:
           [
               'title'=>'create_department',
               'description'=>'Creating new medical department'
           ],
           [
               'title'=>'update_department',
               'description'=>'updating an existing medical department'
           ],
           [
               'title'=>'delete_department',
               'description'=>'deleting a medical department'
           ],
            //---------User management:
           [
               'title'=>'read_user',
               'description'=>'Viewing a user'
           ],
           [
               'title'=>'update_user',
               'description'=>'promoting or demoting an existing user'
           ],
           [
               'title'=>'delete_user',
               'description'=>'deleting a user'
           ],
           [
               'title'=>'index_user',
               'description'=>'Viewing the index of all users'
           ],
            //---------Doctors management:
           [
               'title'=>'create_doctor',
               'description'=>'Creating new doctor'
           ],
           [
               'title'=>'update_doctor',
               'description'=>'promoting or demoting an existing doctor'
           ],
           [
               'title'=>'delete_doctor',
               'description'=>'deleting a doctor'
           ],
            //---------Role management:
            [
                'title'=>'create_role',
                'description'=>'Creating new role'
            ],
            [
                'title'=>'read_role',
                'description'=>'Viewing a role'
            ],
            [
                'title'=>'update_role',
                'description'=>'updating an existing role'
            ],
            [
                'title'=>'delete_role',
                'description'=>'deleting a role'
            ],
            //---------Appointment management:
            [
                'title'=>'create_appointment',
                'description'=>'Creating new appointment'
            ],
            [
                'title'=>'read_appointment',
                'description'=>'Viewing a appointment'
            ],
            [
                'title'=>'update_appointment',
                'description'=>'updating an existing appointment'
            ],
            [
                'title'=>'delete_appointment',
                'description'=>'deleting a appointment'
            ],
            //---------Working-Hours management:
            [
                'title'=>'create_working_hour',
                'description'=>'Creating new working hour'
            ],
            [
                'title'=>'doctor_update_working_hour',
                'description'=>'updating an existing working hour as a doctor'
            ],
            [
                'title'=>'admin_update_working_hour',
                'description'=>'updating an existing working hour as admin'
            ],
            [
                'title'=>'delete_working_hour',
                'description'=>'deleting a working hour'
            ],
            //----------Working-days management:
            [
                'title'=>"create_wd",
                'description'=>"creating new working day for a doctor"
            ],
            [
                'title'=>"update_wd",
                'description'=>"updating an existing working day for a doctor"
            ],
            [
                'title'=>"delete_wd",
                'description'=>"deleting a working day for a doctor"
            ],
        ]);
    }
}
