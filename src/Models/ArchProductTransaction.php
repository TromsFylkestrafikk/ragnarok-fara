<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $transactionida
 * @property int $orderid
 * @property int $productclassno
 * @property int $productsubclassno
 * @property int $ioproducttemplateid
 * @property string $productownercompanyid
 * @property string $serviceoperatorcompanyid
 * @property string $serviceprovidercompanyid
 * @property string $productretailercompanyid
 * @property int $ticketsequencenumber
 * @property string $operationaldate
 * @property string $tariffcompanyid
 * @property int $tariffno
 * @property string $producttemplatecompanyid
 * @property int $producttemplateno
 * @property string|null $cardvalidityenddate
 * @property string|null $applicationvalidityenddate
 * @property string|null $applicationsequenceno
 * @property string|null $productsequenceno
 * @property string|null $productapplicationsequenceno
 * @property string|null $applicationserialno
 * @property string|null $applicationrecyclecount
 * @property string|null $applicationtemplateno
 * @property string|null $applicationtemplatecompanyid
 * @property string|null $cardcompanyid
 * @property string|null $cardserialno
 * @property int|null $cardtypeid
 * @property string|null $cardholderbirthdate
 * @property int|null $cardholdercustomerprofileid1
 * @property string|null $cardholderprofileenddate1
 * @property int|null $cardholdercustomerprofileid2
 * @property string|null $cardholderprofileenddate2
 * @property string|null $previouspursebalance
 * @property string|null $newpursebalance
 * @property string|null $productexpiredatetime
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationrecyclecount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationtemplatecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationtemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereApplicationvalidityenddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardholderbirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardholdercustomerprofileid1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardholdercustomerprofileid2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardholderprofileenddate1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardholderprofileenddate2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardserialno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardtypeid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereCardvalidityenddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereIoproducttemplateid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereNewpursebalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereOperationaldate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction wherePreviouspursebalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductapplicationsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductclassno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductexpiredatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductownercompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductretailercompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductsequenceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProductsubclassno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProducttemplatecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereProducttemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereServiceoperatorcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereServiceprovidercompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereTariffcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereTariffno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereTicketsequencenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchProductTransaction whereTransactionida($value)
 * @mixin \Eloquent
 */
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
