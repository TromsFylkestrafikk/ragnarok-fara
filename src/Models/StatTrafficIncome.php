<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $dat
 * @property string $companyid
 * @property string $operatorid
 * @property string $routecompanyid
 * @property int $linenumber
 * @property int $journeyno
 * @property int $assistanceno
 * @property string $prodcompanyid
 * @property int $prodtemplateno
 * @property int $custprofileid
 * @property int $paymentmethodid
 * @property int $vehiclerunno
 * @property string|null $amountofproductssale
 * @property int|null $numberofproductssale
 * @property string $clearingperiodida
 * @property string|null $lastupdated
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereAmountofproductssale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereAssistanceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereClearingperiodida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereCompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereCustprofileid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereDat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereJourneyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereLastupdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereLinenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereNumberofproductssale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereOperatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome wherePaymentmethodid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereProdcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereProdtemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereRoutecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficIncome whereVehiclerunno($value)
 * @mixin \Eloquent
 */
class StatTrafficIncome extends Model
{
    public $timestamps = false;
    protected $table = 'stattrafficincome';
    protected $connection = 'fara_remote';
}
