<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloodrequests extends Model
{
    protected $fillable = [
        'user_id',
        'blood_group',
        'volume',
        'reason',
    ];
}
