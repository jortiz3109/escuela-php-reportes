<?php

namespace Exports;

use App\Exports\ExportStrategy;
use App\Models\Field;
use App\Models\Report;
use Carbon\Carbon;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\HasExportProviders;
use Tests\TestCase;

class FormatExportTest extends TestCase
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
        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        $filename = 'reports/report_' . now()->timestamp . '.' . $extension;
        $this->assertTrue(Storage::exists($filename));
        Storage::delete($filename);
    }

    /**
     * @test
     * @dataProvider csvProvider
     */
    public function anUserCanExportDataFromBuilderToCSV(string $extension, array $filters)
    {
        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        $filename = 'reports/report_' . now()->timestamp . '.' . $extension;
        $this->assertTrue(Storage::exists($filename));
        Storage::delete($filename);
    }

    /**
     * @test
     * @dataProvider tsvProvider
     */
    public function anUserCanExportDataFromBuilderToTSV(string $extension, array $filters)
    {
        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        $filename = 'reports/report_' . now()->timestamp . '.' . $extension;
        $this->assertTrue(Storage::exists($filename));
        Storage::delete($filename);
    }
}
