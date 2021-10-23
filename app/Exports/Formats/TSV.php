<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\FormatBase;
use App\Exports\ReportExport;
use Illuminate\Database\Eloquent\Builder;

class TSV extends FormatBase
{
    public function export(Builder $builder): void
    {
        (new ReportExport($builder))->queue(static::fileName() . '.tsv');
    }
}
