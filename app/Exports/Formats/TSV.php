<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatContract;
use App\Exports\ReportExport;
use Illuminate\Database\Eloquent\Builder;

class TSV implements FormatContract
{
    public function export(Builder $builder): void
    {
        (new ReportExport($builder))->queue('report.tsv');
    }
}
