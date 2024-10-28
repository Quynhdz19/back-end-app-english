<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Video::create([
                'user_id' => $i,
                'name_video' => 'Lập trình ' . $i,
                'url_video' => 'https://www.youtube.com/watch?v=pWpiuX38yHE',
            ]);
        }
    }
}
