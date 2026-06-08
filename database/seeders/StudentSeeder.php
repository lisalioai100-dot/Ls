<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           'is_admin'=>true,
            'name' => 'Lisa lio',
            'email' => 'lisalioai100@gmail.com', 
            'password' => Hash::make('3322149lisalioai'),
        ]);
    }
}
