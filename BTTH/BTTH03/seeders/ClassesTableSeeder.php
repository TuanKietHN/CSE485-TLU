<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mảng dữ liệu mẫu để chèn vào bảng classes
        $classes = [
            ['grade_level' => 'Pre-K', 'room_number' => '101', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Pre-K', 'room_number' => '102', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Kindergarten', 'room_number' => '103', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Kindergarten', 'room_number' => '104', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Pre-K', 'room_number' => '105', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Kindergarten', 'room_number' => '106', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Pre-K', 'room_number' => '107', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Kindergarten', 'room_number' => '108', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Pre-K', 'room_number' => '109', 'created_at' => now(), 'updated_at' => now()],
            ['grade_level' => 'Kindergarten', 'room_number' => '110', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Chèn dữ liệu vào bảng classes
        DB::table('classes')->insert($classes);
    }
}
