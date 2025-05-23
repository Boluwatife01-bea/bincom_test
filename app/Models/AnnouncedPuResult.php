<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncedPuResult extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'polling_unit_uniqueid',
        'party_abbreviation',
        'party_score',
        'entered_by_user',
        'date_entered',
        'user_ip_address', 
    ];
}


