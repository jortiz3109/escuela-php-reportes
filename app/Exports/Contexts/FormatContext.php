<?php

namespace App\Exports\Contexts;

use App\Exports\Contracts\FormatContract;
use Illuminate\Database\Eloquent\Builder;

class FormatContext
{
    private FormatContract $strategy;

    public function __construct(FormatContract $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(Builder $builder): void
    {
        $this->strategy->export($builder);
    }
}
