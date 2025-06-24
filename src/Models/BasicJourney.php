<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $journeyida
 * @property string $lineida
 * @property int $journeyno
 * @property string $calendarida
 * @property string|null $remarkida
 * @property string|null $remark2ida
 * @property int|null $destnodep
 * @property string|null $publiclineno
 * @property string|null $journeypatternida
 * @property int|null $departuretime
 * @property int|null $packagetour
 * @property int|null $announcementtype
 * @property string|null $tariffid
 * @property int|null $transporttypeid
 * @property int|null $destnoarrival
 * @property int|null $trafficdays
 * @property string $serviceproviderid
 * @property int $inversecalendar
 * @property int $direction
 * @property string|null $tarifftype
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereAnnouncementtype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereCalendarida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereDeparturetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereDestnoarrival($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereDestnodep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereInversecalendar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereJourneyida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereJourneyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereJourneypatternida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereLineida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney wherePackagetour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney wherePubliclineno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereRemark2ida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereRemarkida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereServiceproviderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereTariffid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereTarifftype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereTrafficdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicJourney whereTransporttypeid($value)
 * @mixin \Eloquent
 */
class BasicJourney extends Model
{
    public $timestamps = false;
    protected $table = 'basicjourney';
    protected $connection = 'fara_remote';
}
