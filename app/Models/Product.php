<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'category_id',
        'name',
        'slug',

        'short_description',
        'description',

        'price',
        'sale_price',

        'stock',

        'sku',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'status',

        'is_featured',
        'is_best_seller',
        'is_new_arrival',
        'is_flash_sale',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_product');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
}