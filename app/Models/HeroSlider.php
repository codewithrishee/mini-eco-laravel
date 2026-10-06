<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
     protected $fillable = [
        'badge',
        'title',
        'description',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
        'image',
        'display_order',
        'status',
    ];
}
