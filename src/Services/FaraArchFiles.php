<?php

namespace Ragnarok\Fara\Services;

use Ragnarok\Fara\Models\ArchShiftTransaction;
use Ragnarok\Sink\Traits\LogPrintf;

class FaraArchFiles
{
    use LogPrintf;

    protected const SEPARATOR = ',';

    public function __construct()
    {
        $this->logPrintfInit('[FaraArchFiles]: ');
    }

    public function getData(string $id)
    {
        $archData = ArchShiftTransaction::with([
                'productTransaction',
                'salePassengerProfile',
            ])
            ->has('productTransaction')
            ->has('salePassengerProfile')
            ->whereDate('eventdatetime', $id)
            ->get();

        $firstRow = $archData->first();
        $stCols = collect($firstRow)->keys()->toArray();
        $ptCols = collect($firstRow->productTransaction)->keys()->toArray();
        $sppValues = collect($firstRow->salePassengerProfile)->values()->toArray();
        $sppCols = collect($sppValues[0])->keys()->toArray();
        $columnNames = array_merge($stCols, $ptCols, $sppCols);
        $data['arch'] = [implode(self::SEPARATOR, $columnNames)];

        $records = 0;
        foreach ($archData as $record) {
            $stValues = collect($record)->values()->toArray();
            $ptValues = collect($record->productTransaction)->values()->toArray();
            $sppArray = collect($record->salePassengerProfile)->values()->toArray();

            // Extra rows will be added in case of duplicate transaction IDs.
            foreach ($sppArray as $sppValues) {
                $values = array_merge($stValues, $ptValues, $sppValues);
                $data['arch'][] = implode(self::SEPARATOR, $values);
                $records += 1;
            }
        }

        $this->debug('Fetched %d records.', $records);
        return $data;
    }
}
