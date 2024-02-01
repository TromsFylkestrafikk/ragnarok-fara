<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchProductTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'producttransaction';
    protected $connection = 'fara_arch_remote';
    protected $visible = [
        'producttemplateno',
    ];
}
