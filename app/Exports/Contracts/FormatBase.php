<?php

namespace App\Exports\Contracts;

use App\Models\Report;

abstract class FormatBase
{
    abstract public function export(Report $report): void;

    public static function fileName(): string
    {
        return 'reports' . ' ' . now()->toDateTimeString();
    }
}
