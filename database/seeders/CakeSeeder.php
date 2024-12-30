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
                'price' => 150000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/1.jpg',
            ],
            [
                'name' => 'Red Velvet Cake',
                'description' => 'Rich red velvet cake with cream cheese frosting.',
                'price' => 200000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/2.jpg',
            ],
            [
                'name' => 'Vanilla Cake',
                'description' => 'Classic vanilla cake with smooth buttercream.',
                'price' => 350000,
                'size' => 'Medium',
                'category_id' => 1,
                'image' => 'img/cake/3.jpg',
            ],
            [
                'name' => 'Black Forest Cake',
                'description' => 'Layered chocolate cake with cherries and cream.',
                'price' => 450000,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/4.jpg',
            ],
            [
                'name' => 'Strawberry Shortcake',
                'description' => 'Light sponge cake with strawberries and cream.',
                'price' => 175000,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/5.jpg',
            ],
            [
                'name' => 'Carrot Cake',
                'description' => 'Moist carrot cake with a hint of cinnamon.',
                'price' => 255000,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/6.jpg',
            ],
            [
                'name' => 'Lemon Drizzle Cake',
                'description' => 'Zesty lemon cake with a sugary glaze.',
                'price' => 287500,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/7.jpg',
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Italian coffee-flavored dessert with mascarpone.',
                'price' => 340000,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/8.jpg',
            ],
            [
                'name' => 'Opera Cake',
                'description' => 'Layered almond sponge cake with coffee buttercream.',
                'price' => 260000,
                'size' => 'Medium',
                'category_id' => 3,
                'image' => 'img/cake/9.jpg',
            ],
            [
                'name' => 'Banana Cake',
                'description' => 'Soft and moist banana cake with a hint of cinnamon.',
                'price' => 190000,
                'size' => 'Medium',
                'category_id' => 2,
                'image' => 'img/cake/10.jpg',
            ],
            [
                'name' => 'Pineapple Cake',
                'description' => 'Tropical pineapple-flavored cake with whipped cream.',
                'price' => 330000,
                'size' => 'Medium',
                'category_id' => 2,
                'image' => 'img/cake/11.jpg',
            ],
            [
                'name' => 'Marble Cake',
                'description' => 'Vanilla and chocolate swirled marble cake.',
                'price' => 325000,
                'size' => 'Medium',
                'category_id' => 2,
                'image' => 'img/cake/12.jpg',
            ],
            [
                'name' => 'Coconut Cake',
                'description' => 'Fluffy coconut cake with shredded coconut topping.',
                'price' => 175000,
                'size' => 'Medium',
                'category_id' => 2,
                'image' => 'img/cake/13.jpg',
            ],
        ]);
    }
}
