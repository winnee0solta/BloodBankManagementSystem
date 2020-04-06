<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipients extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'blood_group',
        'volume',
    ];
}
