<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Video;

class VideoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getAllVideo()
    {
        // select * from courses
        return Video::all();

    }


}
