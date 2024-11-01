<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'contact' => '1234567890',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
