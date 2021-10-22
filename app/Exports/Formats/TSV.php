<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatContract;
use Maatwebsite\Excel\Facades\Excel;

class TSV implements FormatContract
{
    public function export($data): bool
    {
        return Excel::store($data, 'report.tsv');
    }
}
