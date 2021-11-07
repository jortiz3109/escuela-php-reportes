<?php

namespace App\Exports;

use App\Models\QueryReport;
use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromQuery, WithMapping
{
    use Exportable;

    public function __construct(protected Report $report)
    {
    }

    public function query(): Builder
    {
        return QueryReport::filter($this->report->fields->toArray());
    }

    public function map($row): array
    {
//        if ($row->transactions_purchase_amount) {
//            $row->transactions_purchase_amount = '$' . $row->transactions_purchase_amount;
//        }
//        if ($row->transactions_created_at) {
//            $row->transactions_created_at = date('F j, Y, g:i a', strtotime($row->transactions_created_at));
//        }

        return $row->toArray();
    }
}
