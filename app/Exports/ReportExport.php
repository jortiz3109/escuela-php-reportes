<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromQuery, WithMapping
{
    use Exportable;

    public function __construct(protected Builder $builder)
    {
    }

    public function query(): Builder
    {
        return $this->builder;
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
    }
}
