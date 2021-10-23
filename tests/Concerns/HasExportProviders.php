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
                'filters' => $this->allFields(),
            ],
        ];
    }

    public function csvProvider(): array
    {
        return [
            'get reports with csv' => [
                'extension' => 'csv',
                'filters' => $this->allFields(),
            ],
        ];
    }

    public function tsvProvider(): array
    {
        return [
            'get reports with tsv' => [
                'extension' => 'tsv',
                'filters' => $this->allFields(),
            ],
        ];
    }
}
