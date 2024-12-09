<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $students = [];

        // Giả sử class_id trong bảng classes đã có các giá trị từ 1 đến 5
        for ($i = 1; $i <= 10; $i++) {
            $students[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->dateTimeBetween('-18 years', '-5 years'),
                'parent_phone' => $faker->phoneNumber,
                'stock' => $faker->numberBetween(0, 100),
                'class_id' => $faker->numberBetween(1, 5), // Giả sử có 5 lớp
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn dữ liệu vào bảng students
        DB::table('students')->insert($students);
    }
}
