<?php

namespace Tests\Concerns;

trait HasFiltersProvider
{
    public function makeFilter(array|string|null $value, string $tableName, string $name, ?string $operator = null): array
    {
        return [
            'name' => $name,
            'table_name' => $tableName,
            'operator' => $operator,
            'value' => $value,
        ];
    }
}
