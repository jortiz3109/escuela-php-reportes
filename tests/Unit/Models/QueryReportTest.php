<?php

namespace Tests\Unit\Models;

use App\Models\QueryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\HasOperatorProviders;
use Tests\TestCase;

class QueryReportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasOperatorProviders;

    /**
     * @test
     * @dataProvider operatorsProvider
     */
    public function aClientCanToApplyFilterToReportsWithOperators(array $fields, int $expectCount): void
    {
        $this->makeDataToQuery();
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        foreach ($fields as $field) {
            $columnName = $field['table_name'] . '_' . $field['name'];
            if(is_array($field['value'])) {
                $this->assertNotFalse(array_search($field['value'][0], array_column($reports, $columnName)));
                $this->assertNotFalse(array_search($field['value'][1], array_column($reports, $columnName)));
            } elseif($field['value'] !== null) {
                $this->assertNotFalse(array_search($field['value'], array_column($reports, $columnName)));
            }
            $this->assertArrayHasKey($columnName, $reports[0]);
        }
        $this->assertSameSize($fields, $reports[0]);
    }

    /**
     * @test
     * @dataProvider operatorLTProvider
     */
    public function aClientCanToApplyFilterToReportsWithLTOperator(array $fields): void
    {
        $this->makeDataToQuery();
        $reports = QueryReport::filter($fields)->get()->toArray();

        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        foreach ($reports as $report) {
            $this->assertTrue($report[$columnName] < $fields[0]['value']);
        }
        $this->assertSameSize($fields, $reports[0]);
        $this->assertArrayHasKey($columnName, $reports[0]);
    }

    /**
     * @test
     * @dataProvider operatorGTProvider
     */
    public function aClientCanToApplyFilterToReportsWithGTOperator(array $fields): void
    {
        $this->makeDataToQuery();
        $reports = QueryReport::filter($fields)->get()->toArray();

        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        foreach ($reports as $report) {
            $this->assertTrue($report[$columnName] > $fields[0]['value']);
        }
        $this->assertSameSize($fields, $reports[0]);
        $this->assertArrayHasKey($columnName, $reports[0]);
    }
}
