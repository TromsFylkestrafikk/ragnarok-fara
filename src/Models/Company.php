<?php

namespace Ragnarok\Fara\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $companyid
 * @property string|null $companyname
 * @property int $countrycode
 * @property int $networkno
 * @property int $companyno
 * @property int $isself
 * @property string|null $companyshortname
 * @property string|null $orgno
 * @property string|null $carddbcompanyid
 * @property string|null $csurl
 * @property int $islocal
 * @property string|null $address
 * @property int|null $postalcodeid
 * @property string|null $accountnumber
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereAccountnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCarddbcompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyshortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCountrycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCsurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIslocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIsself($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereNetworkno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereOrgno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company wherePostalcodeid($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    public $timestamps = false;
    protected $table = 'company';
    protected $connection = 'fara_remote';
}
