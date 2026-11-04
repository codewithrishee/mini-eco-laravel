<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramGallery extends Model
{
    protected $fillable = [
        'image',
        'image_public_id',
        'link',
        'status',
        'display_order',
    ];
}
