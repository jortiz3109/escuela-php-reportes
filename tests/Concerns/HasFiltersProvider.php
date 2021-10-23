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

    public function allFields(): array
    {
        return [
            $this->makeFilter(null, 'transactions', 'reference'),
            $this->makeFilter(null, 'transactions', 'purchase_amount'),
            $this->makeFilter(null, 'transactions', 'platform_amount'),
            $this->makeFilter(null, 'transactions', 'truncated_pan'),
            $this->makeFilter(null, 'transactions', 'status'),
            $this->makeFilter(null, 'transactions', 'ip'),
            $this->makeFilter(null, 'transactions', 'created_at'),
            $this->makeFilter(null, 'currencies', 'alphabetic_code'),
            $this->makeFilter(null, 'merchants', 'name'),
            $this->makeFilter(null, 'countries', 'alpha_3_code'),
            $this->makeFilter(null, 'payers', 'name'),
            $this->makeFilter(null, 'payers', 'email'),
        ];
    }
}
