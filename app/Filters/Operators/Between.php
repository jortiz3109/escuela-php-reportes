<?php

namespace App\Filters\Operators;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class Between extends FilterContract
{
    public function apply(Builder $query, string $field, array|string|null $value): Builder
    {
        return $query->whereBetween($field, $value);
    }
}
