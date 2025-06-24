<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ragnarok\Fara\Models\ArchProductTransaction;
use Ragnarok\Fara\Models\ArchSalePassengerProfile;

/**
 * 
 *
 * @property string $transactionida
 * @property int $centralsystemcompanyno
 * @property string $transupdatedatetime
 * @property bool $isexported
 * @property string $rawtransactionida
 * @property int $transtypeid
 * @property int $formatversion
 * @property string $eventdatetime
 * @property string $eventsequenceno
 * @property string $transcreatorcompanyid
 * @property string $operatorcompanyid
 * @property string $operatorid
 * @property int $shiftcounter
 * @property string $operatorcardcompanyid
 * @property string $operatorcardserialno
 * @property int $operatorcardtypeid
 * @property string $devicecompanyid
 * @property string $deviceserialno
 * @property-read ArchProductTransaction|null $productTransaction
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ArchSalePassengerProfile> $salePassengerProfile
 * @property-read int|null $sale_passenger_profile_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereCentralsystemcompanyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereDevicecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereDeviceserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereEventdatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereEventsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereFormatversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereIsexported($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereOperatorcardcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereOperatorcardserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereOperatorcardtypeid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereOperatorcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereOperatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereRawtransactionida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereShiftcounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereTransactionida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereTranscreatorcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereTranstypeid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchShiftTransaction whereTransupdatedatetime($value)
 * @mixin \Eloquent
 */
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
