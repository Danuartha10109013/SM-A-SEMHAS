<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('users')->insert([
            'name' => 'ALL ',
            'username' => 'all',
            'email' => 'all@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'all',
            'email_verified_at' => now(),
            'password' => Hash::make('all'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
