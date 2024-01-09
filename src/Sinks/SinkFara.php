<?php

namespace Ragnarok\Fara\Sinks;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Ragnarok\Fara\Facades\FaraFiles;
use Ragnarok\Sink\Models\SinkFile;
use Ragnarok\Sink\Models\RawFile;
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
        return new Carbon('2017-04-27');
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
    public function fetch(string $id): SinkFile|null
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getChunkVersion(string $id): string
    {
        $checksums = RawFile::where('sink_id', static::$id)
            ->where('name', 'LIKE', '%' . $id . '%')
            ->orderBy('name', 'asc')
            ->pluck('checksum')
            ->toArray();
        return md5(implode('', $checksums));
    }

    /**
     * @inheritdoc
     */
    public function getChunkFiles(string $id): Collection
    {
        return RawFile::where('sink_id', static::$id)
            ->where('name', 'LIKE', '%' . $id . '%')
            ->get();
    }

    /**
     * @inheritdoc
     */
    public function removeChunk(string $id): bool
    {
        $this->faraFiles->setPath($id);
        foreach ($this->getLocalFileList($id) as $filename) {
            $this->faraFiles->rmfile(basename($filename));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function import(string $id, SinkFile $file): int
    {
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function deleteImport(string $id, SinkFile $file): bool
    {
        return true;
    }

    protected function getLocalFileList($id)
    {
        return RawFile::where('sink_id', static::$id)
            ->where('name', 'LIKE', '%' . $id . '%')
            ->pluck('name');
    }

    protected function filename($name): string
    {
        return $name . '.csv';
    }
}
