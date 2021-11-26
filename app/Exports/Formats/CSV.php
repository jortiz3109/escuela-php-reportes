<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatBase;
use App\Exports\ReportExport;
use App\Models\Report;

class CSV extends FormatBase
{
    public function export(Report $report): void
    {
        (new ReportExport($report))->store(static::fileName() . '.csv');
    }
}
