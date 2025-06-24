<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $stopno
 * @property string $stopname
 * @property string $stopshortname
 * @property string|null $tariffzone
 * @property int|null $xcoordinate
 * @property int|null $ycoordinate
 * @property int $zoneid
 * @property int|null $stoptype
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereStopname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereStopno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereStopshortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereStoptype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereTariffzone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereXcoordinate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereYcoordinate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicStop whereZoneid($value)
 * @mixin \Eloquent
 */
class BasicStop extends Model
{
    public $timestamps = false;
    protected $table = 'basicstop';
    protected $connection = 'fara_remote';
}
