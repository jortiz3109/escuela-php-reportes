<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\FormatBase;
use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;

class FormatContext
{
    private FormatBase $strategy;

    public function __construct(FormatBase $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(Report $report): void
    {
        $this->strategy->export($report);
    }
}
