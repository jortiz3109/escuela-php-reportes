<?php

namespace Exports;

use App\Exports\ExportStrategy;
use App\Exports\ReportExport;
use App\Models\QueryReport;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Maatwebsite\Excel\Facades\Excel;
use Tests\Concerns\HasExportProviders;
use Tests\TestCase;

class ReportExportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasExportProviders;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseTestSeeder::class);
    }

    /**
     * @test
     * @dataProvider xlsxProvider
     */
    public function anUserCanExportDataFromBuilderToXLSX(string $extension, array $filters)
    {
        Excel::fake();

        ExportStrategy::applyFormat($extension, QueryReport::filter($filters));

        Excel::assertQueued('report.xlsx', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider csvProvider
     */
    public function anUserCanExportDataFromBuilderToCSV(string $extension, array $filters)
    {
        Excel::fake();

        ExportStrategy::applyFormat($extension, QueryReport::filter($filters));

        Excel::assertQueued('report.csv', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider tsvProvider
     */
    public function anUserCanExportDataFromBuilderToTSV(string $extension, array $filters)
    {
        Excel::fake();

        ExportStrategy::applyFormat($extension, QueryReport::filter($filters));

        Excel::assertQueued('report.tsv', fn (ReportExport $export) => true);
    }
}
