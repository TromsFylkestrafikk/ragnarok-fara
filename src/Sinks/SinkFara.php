<?php

namespace Ragnarok\Fara\Sinks;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        $records = 0;
        foreach ($this->getLocalFileList($id) as $filename) {
            $content = $this->faraFiles->getDisk()->get($filename);
            $records += FaraFiles::exportToDb($filename, $content);
        }
        return $records;
    }

    /**
     * @inheritdoc
     */
    public function deleteImport($id): bool
    {
        DB::table('fara_stat_load')->where('dat', $id)->delete();
        DB::table('fara_stat_traffic_cust_profile')->where('dat', $id)->delete();
        DB::table('fara_stat_traffic_income')->where('dat', $id)->delete();

        // Truncate the 'static' tables when all other tables are empty.
        $count = DB::table('fara_stat_load')->count();
        $count += DB::table('fara_stat_traffic_cust_profile')->count();
        $count += DB::table('fara_stat_traffic_income')->count();
        if ($count === 0) {
            DB::table('fara_basic_journey')->delete();
            DB::table('fara_basic_line')->delete();
            DB::table('fara_basic_stop')->delete();
            DB::table('fara_basic_template')->delete();
            DB::table('fara_company')->delete();
            DB::table('fara_customer_profile')->delete();
        }
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
