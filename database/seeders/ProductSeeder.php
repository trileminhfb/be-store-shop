<?php

namespace Database\Seeders;

use App\Enums\gender\gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->delete();
        DB::table('product')->truncate();
        DB::table('product')->insert([
            [
                'name' => 'Quần nam 1',
                'price' => 100000,
                'description' => 'Description 1',
                'image' => '/storage/images/men.jpg',
                'quantity' => 100,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 1',
                'price' => 200000,
                'description' => 'Description 2',
                'image' => '/storage/images/women.jpg',
                'quantity' => 100,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 2',
                'price' => 110000,
                'description' => 'Description 3',
                'image' => '/storage/images/men.jpg',
                'quantity' => 80,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 2',
                'price' => 210000,
                'description' => 'Description 4',
                'image' => '/storage/images/women.jpg',
                'quantity' => 90,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 3',
                'price' => 120000,
                'description' => 'Description 5',
                'image' => '/storage/images/men.jpg',
                'quantity' => 70,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 3',
                'price' => 220000,
                'description' => 'Description 6',
                'image' => '/storage/images/women.jpg',
                'quantity' => 60,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 4',
                'price' => 130000,
                'description' => 'Description 7',
                'image' => '/storage/images/men.jpg',
                'quantity' => 90,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 4',
                'price' => 230000,
                'description' => 'Description 8',
                'image' => '/storage/images/women.jpg',
                'quantity' => 85,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 5',
                'price' => 140000,
                'description' => 'Description 9',
                'image' => '/storage/images/men.jpg',
                'quantity' => 75,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 5',
                'price' => 240000,
                'description' => 'Description 10',
                'image' => '/storage/images/women.jpg',
                'quantity' => 65,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 6',
                'price' => 150000,
                'description' => 'Description 11',
                'image' => '/storage/images/men.jpg',
                'quantity' => 95,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 6',
                'price' => 250000,
                'description' => 'Description 12',
                'image' => '/storage/images/women.jpg',
                'quantity' => 85,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 7',
                'price' => 160000,
                'description' => 'Description 13',
                'image' => '/storage/images/men.jpg',
                'quantity' => 70,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 7',
                'price' => 260000,
                'description' => 'Description 14',
                'image' => '/storage/images/women.jpg',
                'quantity' => 80,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 8',
                'price' => 170000,
                'description' => 'Description 15',
                'image' => '/storage/images/men.jpg',
                'quantity' => 85,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 8',
                'price' => 270000,
                'description' => 'Description 16',
                'image' => '/storage/images/women.jpg',
                'quantity' => 75,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 9',
                'price' => 180000,
                'description' => 'Description 17',
                'image' => '/storage/images/men.jpg',
                'quantity' => 90,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 9',
                'price' => 280000,
                'description' => 'Description 18',
                'image' => '/storage/images/women.jpg',
                'quantity' => 95,
                'gender' => 0,
            ],
            [
                'name' => 'Quần nam 10',
                'price' => 190000,
                'description' => 'Description 19',
                'image' => '/storage/images/men.jpg',
                'quantity' => 75,
                'gender' => 1,
            ],
            [
                'name' => 'Quần nữ 10',
                'price' => 290000,
                'description' => 'Description 20',
                'image' => '/storage/images/women.jpg',
                'quantity' => 85,
                'gender' => 0,
            ],
        ]);

    }
}
