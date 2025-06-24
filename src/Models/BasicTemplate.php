<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $templateid
 * @property string $companyid
 * @property int $templateno
 * @property int $classid
 * @property string $description
 * @property int $seqno
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereClassid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereCompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereSeqno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereTemplateid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BasicTemplate whereTemplateno($value)
 * @mixin \Eloquent
 */
class BasicTemplate extends Model
{
    public $timeatamps = false;
    protected $table = 'basictemplate';
    protected $connection = 'fara_remote';
}
