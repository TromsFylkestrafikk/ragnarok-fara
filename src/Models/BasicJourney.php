<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

class BasicJourney extends Model
{
    public $timestamps = false;
    protected $table = 'basicjourney';
    protected $connection = 'fara_remote';
}
