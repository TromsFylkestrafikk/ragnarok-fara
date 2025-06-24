<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $dat
 * @property string $companyid
 * @property string $routecompanyid
 * @property int $linenumber
 * @property int $journeyno
 * @property int $assistanceno
 * @property string $prodcompanyid
 * @property int $prodtemplateno
 * @property int $custprofileid
 * @property int $zone
 * @property int $stop
 * @property int|null $numberofproductsuse
 * @property int $numberofproductsoff
 * @property string|null $lastupdated
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereAssistanceno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereCompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereCustprofileid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereDat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereJourneyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereLastupdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereLinenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereNumberofproductsoff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereNumberofproductsuse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereProdcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereProdtemplateno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereRoutecompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatLoad whereZone($value)
 * @mixin \Eloquent
 */
class StatLoad extends Model
{
    public $timestamps = false;
    protected $table = 'statload';
    protected $connection = 'fara_remote';
}
