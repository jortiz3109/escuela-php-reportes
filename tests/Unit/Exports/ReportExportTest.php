<?php

namespace Exports;

use App\Exports\Extended\ExportDecorator\Contracts\FormatBase;
use App\Exports\Extended\ExportDecorator\ExportStrategy;
use App\Exports\Extended\ExportDecorator\ReportExport;
use App\Models\QueryReport;
use Carbon\Carbon;
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
        Carbon::setTestNow();
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

        Excel::assertQueued(FormatBase::fileName() . '.xlsx', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider csvProvider
     */
    public function anUserCanExportDataFromBuilderToCSV(string $extension, array $filters)
    {
        Excel::fake();

        ExportStrategy::applyFormat($extension, QueryReport::filter($filters));

        Excel::assertQueued(FormatBase::fileName() . '.csv', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider tsvProvider
     */
    public function anUserCanExportDataFromBuilderToTSV(string $extension, array $filters)
    {
        Excel::fake();

        ExportStrategy::applyFormat($extension, QueryReport::filter($filters));

        Excel::assertQueued(FormatBase::fileName() . '.tsv', fn (ReportExport $export) => true);
    }
}
