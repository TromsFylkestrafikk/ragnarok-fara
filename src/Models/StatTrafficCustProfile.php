<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class StatTrafficCustProfile extends Model
{
    public $timestamps = false;
    protected $table = 'stattrafficcustprofile';
    protected $connection = 'fara_remote';
}
