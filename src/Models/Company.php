<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $table = 'company';
    protected $connection = 'fara_remote';
}
