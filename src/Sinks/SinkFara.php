<?php

namespace Ragnarok\Fara\Sinks;

use Illuminate\Support\Carbon;
use Ragnarok\Sink\Services\LocalFiles;
use Ragnarok\Sink\Sinks\SinkBase;
use Ragnarok\Sink\Traits\LogPrintf;

class SinkFara extends SinkBase
{
    use LogPrintf;

    public static $id = "fara";
    public static $title = "Fara";

    /**
     * @var LocalFiles
     */
    protected $faraFiles = null;

    public function __construct()
    {
        $this->faraFiles = new LocalFiles(static::$id);
        $this->logPrintfInit('[SinkFara]: ');
    }

    /**
     * @inheritdoc
     */
    public function getFromDate(): Carbon
    {
        return new Carbon('2023-10-01');
    }

    /**
     * @inheritdoc
     */
    public function getToDate(): Carbon
    {
        return today()->subDay();
    }

    /**
     * @inheritdoc
     */
    public function fetch($id): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function removeChunk($id): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function import($id): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteImport($id): bool
    {
        return true;
    }
}
