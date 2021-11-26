<?php

namespace App\Filters;

use App\Filters\Operators\OperatorFactory;
use App\Helpers\FieldsHelper;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    public function __construct(public Builder $query, public array $filters)
    {
    }

    public function buildQuery(): self
    {
        foreach ($this->filters as $filter) {
            $columnName = FieldsHelper::getFieldName($filter);
            OperatorFactory::make($filter['operator'])->apply($this->query, $columnName, $filter['value']);
            $this->orderBy($columnName, $filter['order']);
        }

        return $this->select();
    }

    public function select(): self
    {
        $selected = array_map(fn ($field) => FieldsHelper::getFieldName($field), $this->filters);
        $this->query->select($selected);

        return $this;
    }

    public function orderBy(string $column, ?string $order): self
    {
        if ($order) {
            $this->query->orderBy($column, $order);
        }
        return $this;
    }

    public function getBuilder(): Builder
    {
        return $this->query;
    }
}
