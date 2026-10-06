<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
    'title',
    'slug',
    'author',
    'image',
    'short_description',
    'content',
    'read_time',
    'is_featured',
    'status',
];
}