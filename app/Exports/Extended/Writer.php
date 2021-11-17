<?php

namespace App\Exports\Extended;

use Maatwebsite\Excel\Writer as ExcelWriter;

class Writer extends ExcelWriter
{
    /**
     * @param int|null $sheetIndex
     *
     * @return Sheet
     */
    public function addNewSheet(int $sheetIndex = null): Sheet
    {
        return new Sheet($this->spreadsheet->createSheet($sheetIndex));
    }
}
