<?php

namespace App\Filters;

use App\Filters\Operators\OperatorFactory;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    public function __construct(public Builder $query, public array $filters)
    {
    }

    public function buildQuery(): self
    {
        foreach ($this->filters as $filter) {
            $columnName = $filter['table_name'] . '_' . $filter['name'];
            OperatorFactory::make($filter['operator'])->apply($this->query, $columnName, $filter['value']);
            $this->query->orderBy($columnName, $filter['order']);
        }

        return $this->select();
    }

    public function select(): self
    {
        $selected = array_map(fn ($field) => $field['table_name'] . '_' . $field['name'], $this->filters);

        $this->query->select($selected);

        return $this;
    }

    public function orderBy(): self
    {
        return $this;
    }

    public function getBuilder(): Builder
    {
        return $this->query;
    }
}
