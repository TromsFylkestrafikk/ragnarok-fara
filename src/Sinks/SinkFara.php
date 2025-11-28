<?php

namespace Ragnarok\Fara\Sinks;

use Illuminate\Support\Carbon;
use Ragnarok\Fara\Facades\FaraArchFiles;
use Ragnarok\Fara\Facades\FaraFiles;
use Ragnarok\Fara\Facades\FaraImporter;
use Ragnarok\Sink\Models\SinkFile;
use Ragnarok\Sink\Services\ChunkArchive;
use Ragnarok\Sink\Services\ChunkExtractor;
use Ragnarok\Sink\Sinks\SinkBase;

class SinkFara extends SinkBase
{
    public static $id = "fara";
    public static $title = "Fara";

    // Re-fetch last month at the 10th every month at 04:00
    // Re-fetch last week every Monday at 04:30
    public $cronRefetchAndImport = [
        ['30 4 * * 1', 'weekly'],
        ['0 4 10 * *', 'monthly']
    ];

    /**
     * @inheritdoc
     */
    public function destinationTables(): array
    {
        return [
            'fara_arch' => 'Ticket sale query (from the Arch database)',
            'fara_basic_journey' => 'Journey information',
            'fara_basic_line' => 'Line information',
            'fara_basic_stop' => 'Stop place details',
            'fara_basic_template' => 'Ticket templates',
            'fara_company' => 'Company details',
            'fara_customer_profile' => 'Customer profile (ticket type)',
            'fara_emv_transaction' => 'EMV Transactions',
            'fara_emv_trans_raw_trans' => 'Mapping between EMV transactions and Raw transactions',
            'fara_raw_transaction' => 'Raw transactions',
            'fara_stat_load' => 'Product information with stop/zone reference',
            'fara_stat_traffic_cust_profile' => 'Product information',
            'fara_stat_traffic_income' => 'Product and payment information',
        ];
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
        $archive = new ChunkArchive(static::$id, $id);
        foreach (FaraFiles::getData($id) as $table => $rows) {
            $content = implode(PHP_EOL, $rows);
            $archive->addFromString($this->filename($table), $content);
        }

        // Fetch data from second database.
        foreach (FaraArchFiles::getData($id) as $table => $rows) {
            $content = implode(PHP_EOL, $rows);
            $archive->addFromString($this->filename($table), $content);
        }
        return $archive->save()->getFile();
    }

    /**
     * @inheritdoc
     */
    public function import(string $id, SinkFile $file): int
    {
        $count = 0;
        $extractor = new ChunkExtractor(static::$id, $file);
        foreach ($extractor->getFiles() as $filepath) {
            $count += FaraImporter::import($filepath);
        }
        return $count;
    }

    /**
     * @inheritdoc
     */
    public function deleteImport(string $id, SinkFile $file): bool
    {
        FaraImporter::deleteImport($id);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function filenameToChunkId(string $filename): string|null
    {
        $matches = [];
        $hits = preg_match('|(?P<date>\d{4}-\d{2}-\d{2})\.zip$|', $filename, $matches);
        return $hits ? $matches['date'] : null;
    }

    /**
     * @inheritdoc
     */
    public function refetchAndImportIdRange(string $range): array
    {
        return match ($range) {
            'weekly' => $this->getWeeklyIdsRange(),
            'monthly' => $this->getMonthlyIdsRange(),
            default => [],
        };
        return [];
    }

    protected function getMonthlyIdsRange(): array
    {
        return [
            today()->subMonth()->startOfMonth()->format('Y-m-d'),
            today()->subMonth()->endOfMonth()->format('Y-m-d'),
        ];
    }

    protected function getWeeklyIdsRange(): array
    {
        return [
            today()->subWeek()->startOfWeek()->format('Y-m-d'),
            today()->subWeek()->endOfWeek()->format('Y-m-d')
        ];
    }

    protected function filename($name): string
    {
        return $name . '.csv';
    }
}
