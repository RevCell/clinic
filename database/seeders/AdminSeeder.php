<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->insert([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make(123456789),
            'role_id'=>Role::query()->where('title','Super Admin')->first()->id
        ]);
    }
}
