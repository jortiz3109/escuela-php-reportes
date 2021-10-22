<?php

namespace Tests\Unit\Models;

use App\Models\QueryReport;
use Database\Seeders\DatabaseTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\HasOperatorProviders;
use Tests\TestCase;

class QueryReportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use HasOperatorProviders;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseTestSeeder::class);
    }

    /**
     * @test
     * @dataProvider operatorEQProvider
     */
    public function aClientCanApplyFiltersWithEQOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value >= $fields[0]['value']);
            $this->assertTrue($value <= $fields[0]['value']);
        }
    }

    /**
     * @test
     * @dataProvider operatorBTProvider
     */
    public function aClientCanApplyFiltersWithBTOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        $min = $fields[0]['value'][0];
        $max = $fields[0]['value'][1];

        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value >= $min);
            $this->assertTrue($value <= $max);
        }
    }

    /**
     * @test
     * @dataProvider operatorGEQProvider
     */
    public function aClientCanApplyFiltersWithGEQOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        $min = $fields[0]['value'];

        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value >= $min);
        }
    }

    /**
     * @test
     * @dataProvider operatorLEQProvider
     */
    public function aClientCanApplyFiltersWithLEQOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        $min = $fields[0]['value'];

        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value <= $min);
        }
    }

    /**
     * @test
     * @dataProvider operatorsProvider
     */
    public function aClientCanToApplyFilterToReportsWithAnyOperators(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        foreach ($fields as $field) {
            $columnName = $field['table_name'] . '_' . $field['name'];
            if (is_array($field['value'])) {
                $this->assertNotFalse(array_search($field['value'][0], array_column($reports, $columnName)));
                $this->assertNotFalse(array_search($field['value'][1], array_column($reports, $columnName)));
            } elseif ($field['value'] !== null) {
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
    public function aClientCanToApplyFilterToReportsWithLTOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        $max = $fields[0]['value'];

        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value < $max);
        }
    }

    /**
     * @test
     * @dataProvider operatorGTProvider
     */
    public function aClientCanToApplyFilterToReportsWithGTOperator(array $fields, int $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);
        $columnName = $fields[0]['table_name'] . '_' . $fields[0]['name'];
        $min = $fields[0]['value'];

        foreach ($reports as $report) {
            $value = $report[$columnName];
            $this->assertTrue($value > $min);
        }
    }

    /**
     * @test
     * @dataProvider fieldsProvider
     */
    public function dataFieldsIsOrderedCorrectly(array $filters)
    {
        $report = QueryReport::filter($filters)->get()->first()->toArray();

        $i = 0;
        foreach ($report as $key => $value) {
            $this->assertEquals($filters[$i]['table_name'] . '_' . $filters[$i]['name'], $key);
            $i++;
        }
    }
}
