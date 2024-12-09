<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            [
                'medicine_id' => 1,
                'brand' => 'Paracetamol',
                'dosage' => '500mg',
                'form' => 'Tablet',
                'price' => 3.50,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 2,
                'brand' => 'Ibuprofen',
                'dosage' => '200mg',
                'form' => 'Capsule',
                'price' => 5.00,
                'stock' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 3,
                'brand' => 'Aspirin',
                'dosage' => '300mg',
                'form' => 'Tablet',
                'price' => 2.75,
                'stock' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các bản ghi mẫu khác nếu cần
        ]);
    }
}
