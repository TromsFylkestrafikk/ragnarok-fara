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
    public function fetch($id): int
    {
        $this->faraFiles->setPath($id);
        $fileSize = 0;
        foreach (FaraFiles::getData($id) as $table => $rows) {
            $content = implode(PHP_EOL, $rows);
            $file = $this->faraFiles->toFile($this->filename($table), $content);
            if (!$file) {
                return 0;
            }
            $fileSize += $file->size;
        }
        return $fileSize;
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
    public function import($id): int
    {
        return 0;
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
