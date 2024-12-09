<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title' => 'Avengers: Endgame',
                'director' => 'Anthony và Joe Russo',
                'release_date' => '2019-04-26',
                'duration' => 181,
                'cinema_id' => 1, // Cinema ID
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Inception',
                'director' => 'Christopher Nolan',
                'release_date' => '2010-07-16',
                'duration' => 148,
                'cinema_id' => 1, // Cinema ID
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Dark Knight',
                'director' => 'Christopher Nolan',
                'release_date' => '2008-07-18',
                'duration' => 152,
                'cinema_id' => 2, // Cinema ID
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
