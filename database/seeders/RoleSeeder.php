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
          [ 'title'=>'Super Admin'],
          [ 'title'=>'Patient']
        ]);

        $admin_roles=Role::query()->where('title','Super Admin')->first();
        $admin_roles->permissions()->attach(Permission::all());

        $patient_roles=Role::query()->where("title",'Patient')->first();
        $permissions=Permission::query()->whereIn('title',[
            'Index_section',
            'read_section',
            'index_doctor',
            'read_doctor',
            'create_appointment',
            'read_appointment',
            'delete_appointment'
        ])->get();
        $patient_roles->permissions()->attach($permissions);
    }
}
