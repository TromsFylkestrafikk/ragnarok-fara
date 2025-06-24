<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $transactionida
 * @property int $customerprofileid
 * @property string $amount
 * @property string $vatamount
 * @property int $numberofpassengers
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile whereCustomerprofileid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile whereNumberofpassengers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile whereTransactionida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArchSalePassengerProfile whereVatamount($value)
 * @mixin \Eloquent
 */
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
