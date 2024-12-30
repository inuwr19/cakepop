<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ivanka',
                'email' => 'ivanka@gmail.com',
                'phone' => '085788694431',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'customer1',
                'email' => 'customer1@gmail.com',
                'phone' => '081246879967',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
