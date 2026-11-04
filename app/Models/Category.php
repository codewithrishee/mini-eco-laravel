<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'image_public_id',
        'status',
        'display_order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}