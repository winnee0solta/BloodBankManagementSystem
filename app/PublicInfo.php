<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicInfo extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'name',
        'contact',
        'age',
        'blood_group',
        'gender',
         'address',
    ];
}
