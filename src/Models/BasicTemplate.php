<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class BasicTemplate extends Model
{
    public $timeatamps = false;
    protected $table = 'basictemplate';
    protected $connection = 'fara_remote';
}
