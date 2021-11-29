<?php

namespace Tests\Feature\Jobs;

use App\Constants\Exports;
use App\Jobs\CreateReportJob;
use App\Models\Field;
use App\Models\Report;
use Carbon\Carbon;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\HasFiltersProvider;
use Tests\TestCase;

class CreateReportJobTest extends TestCase
{
    use RefreshDatabase;
    use HasFiltersProvider;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
        $this->seed(DatabaseTestSeeder::class);
    }

    /**
     * @dataProvider extensionProvider
     * @test
     */
    public function AReportIsSuccessfullyCreated(string $extension): void
    {
        $report = Report::factory()->create([
            'extension' => $extension,
        ]);

        foreach ($this->allFields() as $field) {
            $field['report_id'] = $report->id;
            $field['order'] = null;
            Field::factory()->create($field);
        }
        CreateReportJob::dispatch($report);

        $filename = 'reports/report_' . now()->timestamp . '.' . $extension;
        $this->assertTrue(Storage::exists($filename));
        Storage::delete($filename);
    }

    public function extensionProvider(): array
    {
        return [
            'extension csv' => [Exports::CSV],
            'extension tsv' => [Exports::TSV],
            'extension xlsx' => [Exports::XSLX],
        ];
    }
}
