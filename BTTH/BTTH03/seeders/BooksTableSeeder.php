<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publication_year' => 2008,
                'genre' => 'Programming',
                'library_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt and David Thomas',
                'publication_year' => 1999,
                'genre' => 'Programming',
                'library_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'publication_year' => 1988,
                'genre' => 'Science',
                'library_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
