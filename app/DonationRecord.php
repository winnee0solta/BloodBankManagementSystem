<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationRecord extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'name',
        'age',
        'gender',
        'address',
        'contact_no',
        'blood_group',
        'volume',
    ];
}
