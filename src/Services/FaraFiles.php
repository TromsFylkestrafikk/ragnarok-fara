<?php

namespace Ragnarok\Fara\Services;

use Ragnarok\Fara\Models\BasicJourney;
use Ragnarok\Fara\Models\BasicLine;
use Ragnarok\Fara\Models\BasicStop;
use Ragnarok\Fara\Models\BasicTemplate;
use Ragnarok\Fara\Models\Company;
use Ragnarok\Fara\Models\CustomerProfile;
use Ragnarok\Fara\Models\StatLoad;
use Ragnarok\Fara\Models\StatTrafficCustProfile;
use Ragnarok\Fara\Models\StatTrafficIncome;
use Ragnarok\Sink\Services\DbBulkInsert;
use Ragnarok\Sink\Traits\LogPrintf;

class FaraFiles
{
    use LogPrintf;

    protected const SEPARATOR = ',';
    protected const TMP_SEPARATOR = '|';

    /**
     * @var array
     */
    protected $localTables = [
        'basicjourney.csv' => 'fara_basic_journey',
        'basicline.csv' => 'fara_basic_line',
        'basicstop.csv' => 'fara_basic_stop',
        'basictemplate.csv' => 'fara_basic_template',
        'company.csv' => 'fara_company',
        'customerprofile.csv' => 'fara_customer_profile',
        'statload.csv' => 'fara_stat_load',
        'stattrafficcustprofile.csv' => 'fara_stat_traffic_cust_profile',
        'stattrafficincome.csv' => 'fara_stat_traffic_income',
    ];

    public function __construct()
    {
        $this->logPrintfInit('[FaraService]: ');
    }

    public function getData($id)
    {
        $columnNames = collect(BasicJourney::first())->keys()->toArray();
        $data['basicjourney'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = BasicJourney::get()->toArray();
        $this->convertToCsv($data, 'basicjourney', $rows);

        $columnNames = collect(BasicLine::first())->keys()->toArray();
        $data['basicline'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = BasicLine::get()->toArray();
        $this->convertToCsv($data, 'basicline', $rows);

        $columnNames = collect(BasicStop::first())->keys()->toArray();
        $data['basicstop'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = BasicStop::get()->toArray();
        $this->convertToCsv($data, 'basicstop', $rows);

        $columnNames = collect(BasicTemplate::first())->keys()->toArray();
        $data['basictemplate'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = BasicTemplate::get()->toArray();
        $this->convertToCsv($data, 'basictemplate', $rows);

        $columnNames = collect(Company::first())->keys()->toArray();
        $data['company'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = Company::get()->toArray();
        $this->convertToCsv($data, 'company', $rows);

        $columnNames = collect(CustomerProfile::first())->keys()->toArray();
        $data['customerprofile'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = CustomerProfile::get()->toArray();
        $this->convertToCsv($data, 'customerprofile', $rows);

        $columnNames = collect(StatLoad::first())->keys()->toArray();
        $data['statload'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = StatLoad::where('dat', $id)->get()->toArray();
        $this->convertToCsv($data, 'statload', $rows);

        $columnNames = collect(StatTrafficCustProfile::first())->keys()->toArray();
        $data['stattrafficcustprofile'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = StatTrafficCustProfile::where('dat', $id)->get()->toArray();
        $this->convertToCsv($data, 'stattrafficcustprofile', $rows);

        $columnNames = collect(StatTrafficIncome::first())->keys()->toArray();
        $data['stattrafficincome'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = StatTrafficIncome::where('dat', $id)->get()->toArray();
        $this->convertToCsv($data, 'stattrafficincome', $rows);
        return $data;
    }

    protected function convertToCsv(&$data, $table, $rows)
    {
        foreach ($rows as $rowValues) {
            $values = [];
            foreach ($rowValues as $value) {
                if (strpos($value, self::SEPARATOR) === false) {
                    $values[] = $value;
                } else {
                    $values[] = '"' . $value . '"';
                }
            }
            $data[$table][] = implode(self::SEPARATOR, $values);
        }
    }

    public function exportToDb($filename, $content)
    {
        $table = $this->localTables[basename($filename)];
        $this->debug('Exporting %s to local database table (%s).', $filename, $table);
        $records = 0;
        $dbCols = [];
        $feeder = new DbBulkInsert($table, 'upsert');
        foreach (explode(PHP_EOL, $content) as $index => $csvRow) {
            if ($index === 0) {
                // Column headers.
                $dbCols = explode(',', $csvRow);
                $feeder->unique($dbCols);
                continue;
            }
            // Prepare values.
            if (strpos($csvRow, '"') !== false) {
                $quote = false;
                foreach (str_split($csvRow) as $k => $char) {
                    if ($char === '"') $quote = !$quote;
                    if (($char === self::SEPARATOR) && $quote) $csvRow[$k] = self::TMP_SEPARATOR;
                }
            }
            $values = explode(',', $csvRow);
            foreach ($values as $k => $val) {
                $value = trim($val, '"');
                $values[$k] = str_replace(self::TMP_SEPARATOR, self::SEPARATOR, $value);
                if (strlen($value) === 0) {
                    $values[$k] = null;
                }
            }
            if (count($dbCols) === count($values)) {
                $feeder->addRecord(array_combine($dbCols, $values));
                $records += 1;
            } else {
                $this->error('Bad input from %s, data row %d: %s', $filename, $index, $csvRow);
            }
        }
        $feeder->flush();
        return $records;
    }
}
