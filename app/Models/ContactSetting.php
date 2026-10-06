<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
protected $fillable = [
    'heading',
    'description',
    'phone',
    'email',
    'address',
    'whatsapp',
];
}