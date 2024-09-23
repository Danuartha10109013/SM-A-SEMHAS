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
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'Ship-Mark',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin User1',
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'role' => '1',
            'status' => '1',
            'type' => 'Ship-Mark',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Form Check',
            'username' => 'adminfc',
            'email' => 'fc@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'Form-Check',
            'email_verified_at' => now(),
            'password' => Hash::make('fcadmin'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Pegawai Form Check',
            'username' => 'pegawaifc',
            'email' => 'fc1@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'Form-Check',
            'email_verified_at' => now(),
            'password' => Hash::make('fcpegawai'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
