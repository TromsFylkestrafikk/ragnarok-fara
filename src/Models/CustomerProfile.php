<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    public $timestamps = false;
    protected $table = 'customerprofile';
    protected $connection = 'fara_remote';
}
