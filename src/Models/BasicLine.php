<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $lineida
 * @property string $routeproviderid
 * @property int $linenumber
 * @property string|null $linename
 * @property string|null $tariffid
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine whereLineida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine whereLinename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine whereLinenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine whereRouteproviderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicLine whereTariffid($value)
 * @mixin \Eloquent
 */
class BasicLine extends Model
{
    public $timestamps = false;
    protected $table = 'basicline';
    protected $connection = 'fara_remote';
}
