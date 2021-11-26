<?php

namespace Exports;

use App\Constants\Exports;
use App\Exports\ExportStrategy;
use App\Models\Field;
use App\Models\Report;
use Carbon\Carbon;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\HasFiltersProvider;
use Tests\TestCase;

class FormatExportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasFiltersProvider;

    private Report|Model $report;

    private const BASE_NAME = 'reports/report_';

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
        $this->seed(DatabaseTestSeeder::class);
        $this->report = Report::factory()->create();
    }

    /**
     * @test
     * @dataProvider extensionProvider
     */
    public function anUserCanExportDataFromBuilderToXLSX(string $extension, array $filters)
    {
        foreach ($filters as $field) {
            $field['report_id'] = $this->report->id;
            Field::factory()->create($field);
        }

        ExportStrategy::applyFormat($extension, $this->report);

        $filename = self::BASE_NAME . now()->timestamp . '.' . $extension;
        $this->assertTrue(Storage::exists($filename));
        Storage::delete($filename);
    }

    public function extensionProvider(): array
    {
        return [
            'extension csv' => [Exports::CSV, $this->allFields()],
            'extension tsv' => [Exports::TSV, $this->allFields()],
            'extension xlsx' => [Exports::XSLX, $this->allFields()],
        ];
    }
}
