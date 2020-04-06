<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminInfo extends Model
{
    protected $fillable = [
        'user_id', 'image', 'name', 'contact', 'address',
    ];
}
