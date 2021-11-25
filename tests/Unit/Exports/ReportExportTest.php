<?php

namespace Tests\Unit\Exports;

use App\Exports\Contracts\FormatBase;
use App\Exports\ExportStrategy;
use App\Exports\ReportExport;
use App\Models\Field;
use App\Models\Report;
use Carbon\Carbon;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Database\Eloquent\Model;
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

    private Report|Model $report;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
        $this->seed(DatabaseTestSeeder::class);
        $this->report = Report::factory()->create();
    }

    /**
     * @test
     * @dataProvider xlsxProvider
     */
    public function anUserCanExportDataFromBuilderToXLSX(string $extension, array $filters)
    {
        Excel::fake();

        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        Excel::assertQueued(FormatBase::fileName() . '.xlsx', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider csvProvider
     */
    public function anUserCanExportDataFromBuilderToCSV(string $extension, array $filters)
    {
        Excel::fake();

        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        Excel::assertQueued(FormatBase::fileName() . '.csv', fn (ReportExport $export) => true);
    }

    /**
     * @test
     * @dataProvider tsvProvider
     */
    public function anUserCanExportDataFromBuilderToTSV(string $extension, array $filters)
    {
        Excel::fake();

        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        Excel::assertQueued(FormatBase::fileName() . '.tsv', fn (ReportExport $export) => true);
    }
}
