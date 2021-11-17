<?php

namespace Tests\Concerns;

trait HasFiltersProvider
{
    public function makeFilter(
        string $tableName,
        string $name,
        ?string $operator = null,
        array|string|null $value = null,
        ?string $order = null
    ): array {
        return [
            'table_name' => $tableName,
            'name' => $name,
            'operator' => $operator,
            'value' => $value,
            'order' => $order,
        ];
    }

    public function allFields(): array
    {
        return [
            $this->makeFilter('transactions', 'reference'),
            $this->makeFilter('transactions', 'purchase_amount'),
            $this->makeFilter('transactions', 'platform_amount'),
            $this->makeFilter('transactions', 'truncated_pan'),
            $this->makeFilter('transactions', 'status'),
            $this->makeFilter('transactions', 'ip'),
            $this->makeFilter('transactions', 'created_at'),
            $this->makeFilter('currencies', 'alphabetic_code'),
            $this->makeFilter('merchants', 'name'),
            $this->makeFilter('countries', 'alpha_3_code'),
            $this->makeFilter('payers', 'name'),
            $this->makeFilter('payers', 'email'),
        ];
    }
}
