<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DaysOfWeek extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DaysOfWeek::query()->insert([
            ['title'=>"monday"],
            ['title'=>"tuesday"],
            ['title'=>"wednesday"],
            ['title'=>"thursday"],
            ['title'=>"friday"],
            ['title'=>"saturday"],
            ['title'=>"sunday"]
        ]);
    }
}
