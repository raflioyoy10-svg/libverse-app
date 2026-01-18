<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ],
            [
                'nama' => 'Member',
                'email' => 'member@gmail.com',
                'password' => Hash::make('member123'), // ← sudah diganti
                'role' => 'member'
            ],
        ]);
    }
}
