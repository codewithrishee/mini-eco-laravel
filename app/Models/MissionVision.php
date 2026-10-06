<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionVision extends Model
{
    protected $fillable = [
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
    ];
}