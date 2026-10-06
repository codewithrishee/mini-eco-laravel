<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInformation extends Model
{
    protected $table = 'store_information';

protected $fillable = [
    'image',
    'heading',
    'description',
    'product_query_text',
    'availability_text',
    'whatsapp_text',
    'support_email',
    'phone',
    'map_url',
];
}