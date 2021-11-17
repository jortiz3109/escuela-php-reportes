<?php

namespace Tests\Feature\Jobs;

use App\Constants\Exports;
use App\Constants\Fields;
use App\Jobs\CreateReportJob;
use App\Models\Field;
use App\Models\Report;
use Carbon\Carbon;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\Concerns\HasFiltersProvider;
use Tests\TestCase;

class CreateReportJobTest extends TestCase
{
    use RefreshDatabase;
    use HasFiltersProvider;

    protected function setUp(): void
    {
        parent::setUp();
        Excel::fake();
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

        Field::factory()->create([
            'name' => 'name',
            'table_name' => 'merchants',
            'operator' => Fields::OPERATOR_EQ,
            'value' => 'Merchant 1',
            'order' => Fields::ORDER_DESC,
            'report_id' => $report->id,
        ]);
        CreateReportJob::dispatch($report);

        Excel::assertQueued('reports' . ' ' . now()->toDateTimeString() . '.' . $extension);
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
