<?php

namespace App\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class LessThanOrEquals extends FilterContract
{
    public function apply(Builder $query, string $field, array|string|null $value): Builder
    {
        return $query->where($field, Fields::OPERATOR_LEQ, $value);
    }
}
