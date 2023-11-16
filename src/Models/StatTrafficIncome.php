<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class StatTrafficIncome extends Model
{
    public $timestamps = false;
    protected $table = 'stattrafficincome';
    protected $connection = 'fara_remote';
}
