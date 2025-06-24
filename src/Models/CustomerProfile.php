<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $custprofileid
 * @property string|null $custprofiledesc
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerProfile whereCustprofiledesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerProfile whereCustprofileid($value)
 * @mixin \Eloquent
 */
class CustomerProfile extends Model
{
    public $timestamps = false;
    protected $table = 'customerprofile';
    protected $connection = 'fara_remote';
}
