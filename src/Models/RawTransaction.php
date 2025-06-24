<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $transida
 * @property string|null $transtypeid
 * @property string|null $serviceproviderid
 * @property string|null $serviceoperatorid
 * @property string|null $productretailerid
 * @property string|null $applicationretailerid
 * @property string|null $producttemplateownerid
 * @property string|null $producttemplateno
 * @property int|null $productapplicationsequenceno
 * @property string|null $applicationtemplateownerid
 * @property int|null $applicationtemplateno
 * @property string|null $applicationtemplatesequenceno
 * @property string|null $applicatoinserialno
 * @property string|null $receivedtimestamp
 * @property string|null $eventtimestamp
 * @property string|null $eventsequenceno
 * @property int|null $orderid
 * @property string|null $settlementseqno
 * @property string|null $operatorcardid
 * @property string|null $operatorcardtypeid
 * @property string|null $operatorcardissuerid
 * @property string|null $operatorcompanyid
 * @property string|null $operatorid
 * @property int|null $usercardtypeid
 * @property string|null $usercardserialno
 * @property string|null $usercardissuerid
 * @property string|null $devicecompanyid
 * @property string|null $deviceserialno
 * @property string|null $recievedfromcompanyid
 * @property int|null $formatversion
 * @property bool|null $isfailed
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereApplicationretailerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereApplicationtemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereApplicationtemplateownerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereApplicationtemplatesequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereApplicatoinserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereDevicecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereDeviceserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereEventsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereEventtimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereFormatversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereIsfailed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOperatorcardid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOperatorcardissuerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOperatorcardtypeid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOperatorcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOperatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereProductapplicationsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereProductretailerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereProducttemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereProducttemplateownerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereReceivedtimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereRecievedfromcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereServiceoperatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereServiceproviderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereSettlementseqno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereTransida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereTranstypeid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereUsercardissuerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereUsercardserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RawTransaction whereUsercardtypeid($value)
 * @mixin \Eloquent
 */
class RawTransaction extends Model
{
    public $timestamps = false;
    protected $table = 'rawtransaction';
    protected $connection = 'fara_remote';
}
