<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->where('account', 'admin')->delete();
        DB::table('users')->insert([
            'account' => 'admin',
            'password' => bcrypt('123123'),
            'id_role' => 1,
            'fullName' => 'Admin',
        ]);
    }
}
