<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComputersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('computers')->insert([
            [
                'computer_name' => 'Dell Inspiron',
                'model' => 'Inspiron 15 3000',
                'operating_system' => 'Windows 11',
                'processor' => 'Intel Core i5',
                'memory' => 8,
                'available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'computer_name' => 'MacBook Pro',
                'model' => 'M1 2020',
                'operating_system' => 'macOS Monterey',
                'processor' => 'Apple M1',
                'memory' => 16,
                'available' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'computer_name' => 'HP Pavilion',
                'model' => 'Pavilion x360',
                'operating_system' => 'Windows 10',
                'processor' => 'Intel Core i7',
                'memory' => 12,
                'available' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
