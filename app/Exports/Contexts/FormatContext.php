<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\Format;
use App\Models\Report;

class FormatContext
{
    public function __construct(private Format $strategy)
    {
    }

    public function execute(Report $report): void
    {
        $this->strategy->export($report);
    }
}
