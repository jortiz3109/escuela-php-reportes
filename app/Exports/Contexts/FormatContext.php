<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\Export;
use App\Models\Report;

class FormatContext
{
    public function __construct(private Export $strategy)
    {
    }

    public function execute(Report $report): void
    {
        $this->strategy->export($report);
    }
}
