<?php

namespace Ragnarok\Fara\Services;

use Illuminate\Support\Facades\DB;
use Ragnarok\Fara\Models\BasicJourney;
use Ragnarok\Fara\Models\BasicLine;
use Ragnarok\Fara\Models\BasicStop;
use Ragnarok\Fara\Models\BasicTemplate;
use Ragnarok\Fara\Models\Company;
use Ragnarok\Fara\Models\CustomerProfile;
use Ragnarok\Fara\Models\EmvTransaction;
use Ragnarok\Fara\Models\EmvTransRawTrans;
use Ragnarok\Fara\Models\RawTransaction;
use Ragnarok\Fara\Models\StatLoad;
use Ragnarok\Fara\Models\StatTrafficCustProfile;
use Ragnarok\Fara\Models\StatTrafficIncome;
use Ragnarok\Sink\Traits\LogPrintf;

class FaraFiles
{
    use LogPrintf;
    protected const SEPARATOR = ',';

    public function getData(string $id)
    {
        $data = [];

        $this->logPrintfInit("[Fara %s]: ", $id);
        $this->debug("Initializing import ...");
        $columnNames = collect(BasicJourney::first())->keys()->toArray();
        $data['basicjourney'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = BasicJourney::get()->toArray();
        $this->convertToCsv($data, 'basicjourney', $rows);
        $this->debug("Converting %s", 'basicjourney');

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

        $columnNames = collect(EmvTransaction::first())->keys()->toArray();
        $data['emvtransaction'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = EmvTransaction::whereDate('transactiondatetime', $id)
            ->get()
            ->toArray();
        $this->convertToCsv($data, 'emvtransaction', $rows);

        $columnNames = collect(RawTransaction::first())->keys()->toArray();
        $data['rawtransaction'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = RawTransaction::whereDate('eventtimestamp', $id)->get()->toArray();
        $this->convertToCsv($data, 'rawtransaction', $rows);

        $columnNames = collect(EmvTransRawTrans::first())->keys()->toArray();
        $data['emvtransrawtrans'] = [implode(self::SEPARATOR, $columnNames)];
        $rows = DB::connection('fara_remote')
            ->table('emvtransrawtrans', 'piv')
            ->join('emvtransaction as emv', 'emv.emvtransida', '=', 'piv.emvtransida')
            ->select("piv.*")
            ->whereDate('emv.transactiondatetime', $id)
            ->get()
            ->toArray();
        $this->convertToCsv($data, 'emvtransrawtrans', $rows);
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
}
