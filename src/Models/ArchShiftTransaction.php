<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ragnarok\Fara\Models\ArchProductTransaction;
use Ragnarok\Fara\Models\ArchSalePassengerProfile;

class ArchShiftTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'shifttransaction';
    protected $connection = 'fara_arch_remote';
    protected $visible = [
        'transactionida',
        'operatorcompanyid',
        'operatorid',
        'eventdatetime',
    ];

    public function productTransaction()
    {
        return $this->hasOne(ArchProductTransaction::class, 'transactionida', 'transactionida');
    }

    public function salePassengerProfile()
    {
        return $this->hasMany(ArchSalePassengerProfile::class, 'transactionida', 'transactionida');
    }
}
