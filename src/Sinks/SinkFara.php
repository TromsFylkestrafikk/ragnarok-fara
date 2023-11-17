<?php

namespace Ragnarok\Fara\Sinks;

use Illuminate\Support\Carbon;
use Ragnarok\Fara\Facades\FaraFiles;
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
    public function fetch($id): bool
    {
        $this->faraFiles->setPath($id);
        foreach (FaraFiles::getData($id) as $table => $rows) {
            $content = implode(PHP_EOL, $rows);
            if (!$this->faraFiles->toFile($this->filename($table), $content)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function removeChunk($id): bool
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
