<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int|null $emvtransida
 * @property int $transida
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransRawTrans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransRawTrans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransRawTrans query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransRawTrans whereEmvtransida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmvTransRawTrans whereTransida($value)
 * @mixin \Eloquent
 */
class EmvTransRawTrans extends Model
{
    public $timestamps = false;
    protected $table = 'emvtransrawtrans';
    protected $connection = 'fara_remote';
}
