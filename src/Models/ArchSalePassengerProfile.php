<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchSalePassengerProfile extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'salepassengerprofile';
    protected $connection = 'fara_arch_remote';
    protected $visible = [
        'customerprofileid',
        'amount',
        'vatamount',
        'numberofpassengers',
    ];
}
