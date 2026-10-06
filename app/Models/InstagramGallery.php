<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramGallery extends Model
{
    protected $fillable = [
        'image',
        'link',
        'status',
        'display_order',
    ];
}