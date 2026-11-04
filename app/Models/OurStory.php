<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurStory extends Model
{
    protected $fillable = [
        'tag',
        'title',
        'highlight_text',
        'description',
        'main_image',
        'main_image_public_id',
        'floating_image',
        'floating_image_public_id',
    ];
}
