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
           //---------Medical Sections:
           [
               'title'=>'index_section',
               'description'=>'Viewing the index of medical sections'
           ],
           [
               'title'=>'create_section',
               'description'=>'Creating new medical section'
           ],
           [
               'title'=>'read_section',
               'description'=>'Viewing a medical section'
           ],
           [
               'title'=>'update_section',
               'description'=>'updating an existing medical section'
           ],
           [
               'title'=>'delete_section',
               'description'=>'deleting a medical section'
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
               'title'=>'index_doctor',
               'description'=>'Viewing the index of all doctors'
           ],
           [
               'title'=>'create_doctor',
               'description'=>'Creating new doctor'
           ],
           [
               'title'=>'read_doctor',
               'description'=>'Viewing a doctor'
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
            //---------Working-time management:
            [
                'title'=>'create_working_time',
                'description'=>'Creating new working time'
            ],
            [
                'title'=>'read_working_time',
                'description'=>'Viewing a working time'
            ],
            [
                'title'=>'update_working_time',
                'description'=>'updating an existing working time'
            ],
            [
                'title'=>'delete_working_time',
                'description'=>'deleting a working time'
            ],
        ]);
    }
}
