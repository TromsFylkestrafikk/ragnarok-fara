<?php

namespace Ragnarok\Fara\Services;

use Illuminate\Support\Facades\DB;
use Ragnarok\Sink\Services\DbBulkInsert;
use Ragnarok\Sink\Traits\LogPrintf;

class FaraImporter
{
    use LogPrintf;

    /**
     * @var array
     */
    protected $localTables = [
        'arch.csv' => 'fara_arch',
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

    /**
     * Columns to be ignored.
     *
     * @var array
     */
    protected $columnFilter = [
        'fara_arch' => [],
        'fara_basic_journey' => ['remarkida', 'remark2ida', 'packagetour', 'announcementtype', 'tariffid', 'tarifftype'],
        'fara_basic_line' => ['tariffid'],
        'fara_basic_stop' => ['stopshortname', 'tariffzone', 'xcoordinate', 'ycoordinate'],
        'fara_basic_template' => [],
        'fara_company' => ['companyshortname', 'csurl', 'address', 'postalcodeid', 'accountnumber'],
        'fara_customer_profile' => [],
        'fara_stat_load' => [],
        'fara_stat_traffic_cust_profile' => [],
        'fara_stat_traffic_income' => [],
    ];

    public function __construct()
    {
        $this->logPrintfInit('[FaraImporter]: ');
    }

    public function import(string $file)
    {
        $this->debug('%s: Importing ...', basename($file));
        $records = 0;
        if (($handle = fopen($file, 'r')) === false) {
            return $records;
        }
        $table = $this->localTables[basename($file)];
        $feeder = new DbBulkInsert($table, 'upsert');
        $headers = fgetcsv($handle);
        if (! is_array($headers)) {
            $this->notice("%s: Empty csv", basename($file));
            return $records;
        }
        $dbCols = array_diff($headers, $this->columnFilter[$table]);
        $feeder->unique($dbCols);
        while (($values = fgetcsv($handle)) !== false) {
            foreach ($values as $k => $val) {
                $value = trim($val, '"');
                if (strlen($value) === 0) {
                    $values[$k] = null;
                }
            }
            $dbVals = array_filter($values, fn($key) => array_key_exists($key, $dbCols), ARRAY_FILTER_USE_KEY);
            $feeder->addRecord(array_combine($dbCols, $dbVals));
            $records += 1;
        }
        fclose($handle);
        $feeder->flush();
        $this->debug('%s: Imported %d records', basename($file), $records);
        return $records;
    }

    public function deleteImport(string $id)
    {
        DB::table('fara_arch')->whereDate('eventdatetime', $id)->delete();
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
            $this->debug('All tables were truncated.');
            return $this;
        }
        $this->debug('Import for %s was deleted.', $id);
        return $this;
    }
}
