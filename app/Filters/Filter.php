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

    public function __construct(public Builder $query, public array $filters)
    {
    }

    public function buildQuery(): Filter
    {
        foreach ($this->filters as $filter) {
            $columnName = $filter['table_name'] . '_' . $filter['name'];
            $this->resolveOperator($filter['operator'])->apply($this->query, $columnName, $filter['value']);
        }

        return $this->select()->orderBy();
    }

    public function resolveOperator(string|null $operator): FilterContract
    {
        $classOperator = self::OPERATORS[$operator];
        return new $classOperator;
    }

    public function select(): Filter
    {
        $selected = [];
        foreach ($this->filters as $field) {
            $columnName = $field['table_name'] . '_' . $field['name'];
            array_push($selected, $columnName);
        }
        $this->query->select($selected);

        return $this;
    }

    public function orderBy(): Filter
    {
        return $this;
    }

    public function getBuilder(): Builder
    {
        return $this->query;
    }
}
