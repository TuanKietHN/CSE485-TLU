<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HardwareDevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('hardware_devices')->insert([
            [
                'device_name' => 'Logitech G502',
                'type' => 'Mouse',
                'status' => true,
                'center_id' => 1, // IT Center ID
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'device_name' => 'Corsair K70',
                'type' => 'Keyboard',
                'status' => true,
                'center_id' => 1, // IT Center ID
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'device_name' => 'HyperX Cloud II',
                'type' => 'Headset',
                'status' => false,
                'center_id' => 2, // IT Center ID
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
