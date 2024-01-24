<?php

namespace Ragnarok\Fara\Facades;

use Illuminate\Support\Facades\Facade;
use Ragnarok\Fara\Services\FaraArchFiles as FAFiles;

/**
 * @method static FFiles getData(string $id)
 */
class FaraArchFiles extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FAFiles::class;
    }
}
