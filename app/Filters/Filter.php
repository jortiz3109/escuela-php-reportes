<?php

namespace App\Filters;

use App\Constants\Fields;
use App\Filters\Contracts\FilterContract;
use App\Filters\Operators\Between;
use App\Filters\Operators\Equals;
use App\Filters\Operators\GreaterThan;
use App\Filters\Operators\GreaterThanOrEquals;
use App\Filters\Operators\LessThan;
use App\Filters\Operators\LessThanOrEquals;
use App\Filters\Operators\NullOperator;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    public const OPERATORS = [
        Fields::OPERATOR_EQ => Equals::class,
        Fields::OPERATOR_BT => Between::class,
        Fields::OPERATOR_LEQ => LessThanOrEquals::class,
        Fields::OPERATOR_GEQ => GreaterThanOrEquals::class,
        Fields::OPERATOR_LT => LessThan::class,
        Fields::OPERATOR_GT => GreaterThan::class,
        null => NullOperator::class,
    ];

    public static function buildQuery(Builder $query, array $filters): Builder
    {
        $selected = [];
        foreach ($filters as $filter) {
            $columnName = $filter['table_name'] . '_' . $filter['name'];
            array_push($selected, $columnName);
            self::resolveOperator($filter['operator'])->apply($query, $columnName, $filter['value']);
        }

        return $query->select($selected);
    }

    public static function resolveOperator(string|null $operator): FilterContract
    {
        $classOperator = self::OPERATORS[$operator];
        return new $classOperator;
    }
}
