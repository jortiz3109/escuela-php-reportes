<?php

namespace App\Exports\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FormatContract
{
    public function export(Builder $builder): void;
}
