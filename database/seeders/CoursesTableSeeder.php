<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Course::create([
                'user_id' => $i,
                'name_course' => 'Lập trình ' . $i,
            ]);
        }
    }
}
