<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class BasicStop extends Model
{
    public $timestamps = false;
    protected $table = 'basicstop';
    protected $connection = 'fara_remote';
}
