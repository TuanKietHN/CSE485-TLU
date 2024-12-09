<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('issues')->insert([
            [
                'computer_id' => 1, // ID của máy tính
                'reported_by' => 'John Doe',
                'reported_date' => Carbon::now(),
                'description' => 'Screen flickers intermittently.',
                'urgency' => 'High',
                'status' => 'Open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'computer_id' => 2,
                'reported_by' => 'Jane Smith',
                'reported_date' => Carbon::now()->subDays(2),
                'description' => 'Battery does not charge.',
                'urgency' => 'Medium',
                'status' => 'In Progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'computer_id' => 3,
                'reported_by' => null,
                'reported_date' => Carbon::now()->subDays(5),
                'description' => 'USB ports are unresponsive.',
                'urgency' => 'Low',
                'status' => 'Resolved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
