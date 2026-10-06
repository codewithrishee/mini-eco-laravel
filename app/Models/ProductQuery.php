<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuery extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'email',
        'subject',
        'message',
    ];


    /**
     * Query kis product ki hai
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}