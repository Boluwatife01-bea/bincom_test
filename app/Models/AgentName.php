<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentName extends Model
{
    namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentName extends Model
{
    protected $table = 'agentname';
    protected $primaryKey = 'name_id';
    public $timestamps = false;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'pollingunit_uniqueid'
    ];
}

}
