<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'rating',
        'image_link',
        'video_link',
        'genre',
        'release_date'
    ];
    protected $hidden = [];
}
