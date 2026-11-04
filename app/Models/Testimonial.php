<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'review',
        'rating',
        'image',
        'image_public_id',
        'display_order',
        'status',
    ];
}
