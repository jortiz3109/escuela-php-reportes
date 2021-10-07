<?php

namespace App\Filters\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterContract
{
    abstract function apply(Builder $query, string $field, string|array|null $value): Builder;
}
