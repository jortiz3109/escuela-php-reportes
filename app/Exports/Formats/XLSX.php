<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatBase;
use App\Exports\ReportExport;
use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;

class XLSX extends FormatBase
{
    public function export(Report $report): void
    {
        (new ReportExport($report))->queue(static::fileName() . '.xlsx');
    }
}
