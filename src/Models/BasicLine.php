<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class BasicLine extends Model
{
    public $timestamps = false;
    protected $table = 'basicline';
    protected $connection = 'fara_remote';
}
