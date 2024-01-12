<?php

namespace Ragnarok\Fara\Facades;

use Illuminate\Support\Facades\Facade;
use Ragnarok\Fara\Services\FaraFiles as FFiles;

/**
 * @method static FFiles getData(string $id)
 */
class FaraFiles extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FFiles::class;
    }
}
