<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_table')->insert([
            [
                'name' => 'Web Development',
                'description' => 'Learn HTML, CSS, JavaScript, and backend development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Data Science',
                'description' => 'Explore data analysis, visualization, and machine learning.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Build Android and iOS apps using Flutter and React Native.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
