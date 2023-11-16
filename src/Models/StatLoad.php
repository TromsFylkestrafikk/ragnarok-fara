<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class StatLoad extends Model
{
    public $timestamps = false;
    protected $table = 'statload';
    protected $connection = 'fara_remote';
}
