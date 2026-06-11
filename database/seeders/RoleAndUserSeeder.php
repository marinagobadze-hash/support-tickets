<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // შევქმნათ ადმინისტრატორი
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // შევქმნათ ჩვეულებრივი მომხმარებელი (კლიენტი)
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'client@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'client',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}