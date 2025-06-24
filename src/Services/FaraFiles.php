<?php

namespace Ragnarok\Fara\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Ragnarok\Fara\Models\EmvTransRawTrans;
use Ragnarok\Sink\Traits\LogPrintf;

class FaraFiles
{
    use LogPrintf;
    protected const SEPARATOR = ',';

    public function getData(string $id)
    {
        // List of FARA connection models that are relatively straight forward
        // to import, The value is a closure used to filter the eloquent
        // builder.
        $simpleModels = [
            'BasicJourney' => null,
            'BasicLine' => null,
            'BasicStop' => null,
            'BasicTemplate' => null,
            'Company' => null,
            'CustomerProfile' => null,
            'EmvTransaction' => fn (string $id, Builder $query) => $query->whereDate('transactiondatetime', $id),
            'RawTransaction' => fn (string $id, Builder $query) => $query->whereDate('eventtimestamp', $id),
            'StatLoad' => fn (string $id, Builder $query) => $query->where('dat', $id),
            'StatTrafficCustProfile' => fn (string $id, Builder $query) => $query->where('dat', $id),
            'StatTrafficIncome' => fn (string $id, Builder $query) => $query->where('dat', $id),
        ];

        $data = [];

        $this->logPrintfInit("[Fara %s]: ", $id);
        $this->debug("Initializing import ...");

        foreach ($simpleModels as $modelBase => $filter) {
            $this->debug("Fetching %s ...", $modelBase);
            $mClass = 'Ragnarok\\Fara\\Models\\' . $modelBase;
            $columnNames = collect(call_user_func($mClass . '::first'))
                ->keys()
                ->toArray();
            $tableName = (new $mClass)->getTable();
            $data[$tableName] = [implode(self::SEPARATOR, $columnNames)];
            $rows = $filter
                ? call_user_func(
                    $mClass . '::where',
                    fn (Builder $query) => $filter($id, $query)
                )->get()->toArray()
                : call_user_func($mClass . '::get')->toArray();
            $this->convertToCsv($data, $tableName, $rows);
        }

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
