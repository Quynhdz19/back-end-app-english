<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Video extends Model
{

    protected $table = 'videos';
    protected $fillable = [
        'user_id',
        'name_video',
        'url_video',
        'created_at',
        'updated_at'
    ];

}


