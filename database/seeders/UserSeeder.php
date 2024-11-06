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
            [
                'name' => 'ALL',
                'username' => 'all',
                'email' => 'all@example.com',
                'role' => '0',
                'status' => '1',
                'type' => json_encode(['all']), // Store type as JSON
                'email_verified_at' => now(),
                'password' => Hash::make('all'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'username' => 'pegawai',
                'email' => 'pegawai@example.com',
                'role' => '1',
                'status' => '1',
                'type' => json_encode(['all']), // Multiple types as JSON
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'username' => 'janesmith',
                'email' => 'jane@example.com',
                'role' => '2',
                'status' => '1',
                'type' => json_encode(['FC', 'OP']),
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
            // Add more users as needed
        ]);
    }
}
