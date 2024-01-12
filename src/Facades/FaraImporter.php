<?php

namespace Ragnarok\Fara\Facades;

use Illuminate\Support\Facades\Facade;
use Ragnarok\Fara\Services\FaraImporter as FImporter;

/**
 * @method static FImporter import(string $file)
 * @method static FImporter deleteImport(string $id)
 */
class FaraImporter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FImporter::class;
    }
}
