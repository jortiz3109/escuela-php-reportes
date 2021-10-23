<?php

namespace Tests\Concerns;

trait HasExportProviders
{
    use HasFiltersProvider;

    public function xlsxProvider(): array
    {
        return [
            'get reports with xlsx' => [
                'extension' => 'xlsx',
                'filters' => [
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
                ],
            ],
        ];
    }

    public function csvProvider(): array
    {
        return [
            'get reports with csv' => [
                'extension' => 'csv',
                'filters' => [
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
                ],
            ],
        ];
    }

    public function tsvProvider(): array
    {
        return [
            'get reports with tsv' => [
                'extension' => 'tsv',
                'filters' => [
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
                ],
            ],
        ];
    }
}
