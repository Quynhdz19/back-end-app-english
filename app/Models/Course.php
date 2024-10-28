<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    protected $table = 'courses';
    protected $fillable = [
        'user_id',
        'name_course',
        'url_bground',
        'created_at',
        'updated_at'
    ];

}


