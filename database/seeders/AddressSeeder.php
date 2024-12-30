<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id' => 1,
                'address' => '123 Main Street, Springfield',
                'city'=> 'Jakarta',
                'postal_code' => '12345',
            ],
            [
                'user_id' => 2,
                'address' => '456 Elm Street, Townsville',
                'city'=> 'Tangerang',
                'postal_code' => '67890',
            ],
        ]);
    }
}
