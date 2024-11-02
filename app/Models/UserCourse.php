<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    // Define the table if it doesn't follow Laravel's pluralization convention
    protected $table = 'user_courses';


    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'course_id',
        'is_favourite',
        'is_in_progress',
        'completed_at'
    ];

    /**
     * Relationship to the User model.
     */
//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class, 'user_id','id');
//    }
//
//    /**
//     * Relationship to the Course model.
//     */
//    public function course(): BelongsTo
//    {
//        return $this->belongsTo(Course::class, 'course_id','id');
//    }
}
