<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * EMV terminal connection
 *
 * @property int|null $emvtransida
 * @property int|null $transactionid
 * @property string|null $terminalid
 * @property string|null $transactionnumber
 * @property int|null $sessionnumber
 * @property string|null $pan
 * @property string|null $cardexpirydate
 * @property string|null $paymentapplicationname
 * @property string|null $applicationid
 * @property string|null $readingmethod
 * @property string|null $transactiondatetime
 * @property string|null $onlineindicator
 * @property string|null $authorizationcode
 * @property int|null $issuerid
 * @property string|null $cardacceptoridcode
 * @property string|null $idmethod
 * @property string|null $amount
 * @property int|null $iscancelled
 * @property int|null $currencyid
 * @property int|null $prcompanyid
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereApplicationid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereAuthorizationcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereCardacceptoridcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereCardexpirydate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereCurrencyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereEmvtransida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereIdmethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereIscancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereIssuerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereOnlineindicator($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction wherePan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction wherePaymentapplicationname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction wherePrcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereReadingmethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereSessionnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereTerminalid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereTransactiondatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereTransactionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransaction whereTransactionnumber($value)
 * @mixin \Eloquent
 */
class EmvTransaction extends Model
{
    public $timestamps = false;
    protected $table = 'emvtransaction';
    protected $connection = 'fara_remote';

    /**
     * Fara annoyingly uses the 'money' column type.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $hits = [];
                preg_match('/^[^\d\.]*(?<value>[0-9\.]*)[^\d\.]*/', $value, $hits);
                return $hits['value'];
            }
        );
    }
}
