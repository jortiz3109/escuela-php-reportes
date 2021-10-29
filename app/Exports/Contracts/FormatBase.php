<?php

namespace App\Exports\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class FormatBase
{
    abstract public function export(Builder $builder): void;

    public static function fileName(): string
    {
        return 'reports' . ' ' . now()->toDateTimeString();
    }
}
