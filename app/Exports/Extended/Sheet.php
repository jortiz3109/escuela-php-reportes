<?php

namespace App\Exports\Extended;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Sheet extends \Maatwebsite\Excel\Sheet
{
    public function fromQuery(FromQuery $sheetExport, Worksheet $worksheet)
    {
        $sheetExport->query()->chunk($sheetExport->chunkSize(), function (Collection $chunk) use ($sheetExport) {
            $this->appendRows($chunk, $sheetExport);
        });
    }
}
