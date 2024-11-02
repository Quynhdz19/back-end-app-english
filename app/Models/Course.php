<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    protected $table = 'courses';
    protected $fillable = [
        'name',
        'img_url',
        'point',
        'created_at',
        'updated_at'
    ];

}


