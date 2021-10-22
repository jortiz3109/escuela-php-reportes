<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatContract;
use Maatwebsite\Excel\Facades\Excel;

class Csv implements FormatContract
{
    public function format($data)
    {
        return Excel::store($data, 'report.csv');
    }
}
