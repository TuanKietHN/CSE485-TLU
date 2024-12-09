<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ITCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('it_centers')->insert([
            [
                'name' => 'Trung tâm Tin học ABC',
                'location' => '456 Đường Y, TP.HCM',
                'contact_email' => 'contact@abc.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trung tâm Tin học XYZ',
                'location' => '123 Đường X, Hà Nội',
                'contact_email' => 'contact@xyz.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
