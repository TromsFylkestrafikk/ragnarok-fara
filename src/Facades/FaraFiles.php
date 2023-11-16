<?php

namespace Ragnarok\Fara\Facades;

use Illuminate\Support\Facades\Facade;
use Ragnarok\Fara\Services\FaraFiles as FFiles;

class FaraFiles extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FFiles::class;
    }
}
