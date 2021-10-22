<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatContract;
use Maatwebsite\Excel\Facades\Excel;

class Xls implements FormatContract
{
    public function format($data)
    {
        Excel::store($data, 'report.xlsx');
    }
}
