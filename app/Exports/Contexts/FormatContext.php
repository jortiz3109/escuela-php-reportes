<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\FormatBase;
use Illuminate\Database\Eloquent\Builder;

class FormatContext
{
    private FormatBase $strategy;

    public function __construct(FormatBase $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(Builder $builder): void
    {
        $this->strategy->export($builder);
    }
}
