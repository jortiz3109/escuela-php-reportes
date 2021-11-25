<?php

namespace App\Exports;

use App\Models\QueryReport;
use App\Models\Report;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;

class ReportExport implements FromQuery, ShouldQueue, WithCustomChunkSize
{
    use Exportable;

    public function __construct(protected Report $report)
    {
    }

    public function query(): Builder
    {
        return QueryReport::filter($this->report->fields->toArray());
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
