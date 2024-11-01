<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        $teacher = DB::table('teachers')->first();

        DB::table('subjects')->insert([
            [
                'name' => 'Mathematics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Physics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chemistry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
