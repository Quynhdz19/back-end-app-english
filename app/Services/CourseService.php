<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCourse()
    {
        //select * from Course
        return Course::all();
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);

        if ($course){
            $course->delete();
            return true;
        }
        return  false;
    }

    public function fillCourse($user_id, $name_course, $url_background)
    {
        return Course::insert([
            'user_id' => $user_id,
            'name_course' => $name_course,
            'url_bground' => $url_background,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
