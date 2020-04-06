<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Systemlogs extends Model
{
    protected $fillable = [
        'user', 'message',
    ];
}
