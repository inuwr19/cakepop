<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cakes')->insert([
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/1.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/2.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/3.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/4.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/5.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/6.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/7.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/8.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/9.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/10.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/11.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/12.jpg',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Delicious chocolate cake with creamy frosting.',
                'price' => 200.000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/13.jpg',
            ],
        ]);
    }
}
