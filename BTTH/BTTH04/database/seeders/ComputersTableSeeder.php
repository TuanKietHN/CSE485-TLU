<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->randomElement([
                    'Dell',
                    'HP',
                    'Lenovo',
                    'Asus',
                    'Acer',
                    'MSI',
                    'Gigabyte',
                    'Microsoft',
                    'Razer',
                    'Huawei',
                ]),
                'model' => $faker->bothify('Series-##'),
                'operating_system' => $faker->randomElement(['Windows 10', 'Windows 11', 'Ubuntu 22.04', 'macOS Ventura','macOS Sonoma']),
                'processor' => $faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
                'memory' => $faker->optional()->numberBetween(4, 64), 
                'available' => $faker->boolean(), 
                'created_at' => now(), 
                'updated_at' => now(),
            ]);
        }
    }
}
