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
            'name' => 'Pegawai Open Packing ',
            'username' => 'pegawaimp',
            'email' => 'op1@example.com',
            'role' => '1',
            'status' => '1',
            'type' => 'Open-Packing',
            'email_verified_at' => now(),
            'password' => Hash::make('mppegawai'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Open Packing ',
            'username' => 'adminop',
            'email' => 'op@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'Open-Packing',
            'email_verified_at' => now(),
            'password' => Hash::make('adminop'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Pegawai Packing List ',
            'username' => 'pegawaisp',
            'email' => 'sp1@example.com',
            'role' => '1',
            'status' => '1',
            'type' => 'Supply',
            'email_verified_at' => now(),
            'password' => Hash::make('pegawaisp'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Supply Bahan ',
            'username' => 'adminsp',
            'email' => 'sp@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'Supply',
            'email_verified_at' => now(),
            'password' => Hash::make('adminsp'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Pegawai Packing List ',
            'username' => 'pegawaipl',
            'email' => 'pl1@example.com',
            'role' => '1',
            'status' => '1',
            'type' => 'PList',
            'email_verified_at' => now(),
            'password' => Hash::make('pegawaipl'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Packing List ',
            'username' => 'adminpl',
            'email' => 'pl@example.com',
            'role' => '0',
            'status' => '1',
            'type' => 'PList',
            'email_verified_at' => now(),
            'password' => Hash::make('adminpl'), // You can use bcrypt or Hash facade
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
