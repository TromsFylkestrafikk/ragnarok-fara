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
 * @property int $vehiclerunno
 * @property int|null $numberofproductsuse
 * @property string|null $lastupdated
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereAssistanceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereCompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereCustprofileid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereDat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereJourneyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereLastupdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereLinenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereNumberofproductsuse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereOperatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereProdcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereProdtemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereRoutecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatTrafficCustProfile whereVehiclerunno($value)
 * @mixin \Eloquent
 */
class StatTrafficCustProfile extends Model
{
    public $timestamps = false;
    protected $table = 'stattrafficcustprofile';
    protected $connection = 'fara_remote';
}
