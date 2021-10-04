<?php

namespace Tests\Unit\Models;

use App\Constants\ExportModels;
use App\Constants\Fields;
use App\Models\Currency;
use App\Models\Field;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\QueryReport;
use App\Models\Report;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\ArrayShape;
use Tests\TestCase;

class QueryReportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        QueryReport::factory(20)->create();
    }

    /**
     * @test
     * @dataProvider fieldProvider
     */
    public function aClientCanToApplyFilterToReports($fields, $expectCount): void
    {
        // TODO crear datos a la vista desde el provider para garantizar que esos datos existan al realizar la consulta
        $reports = QueryReport::filter($fields)->get();

        $this->assertEquals($reports->count(), $expectCount);

        foreach ($fields as $field) {
            if(is_array($field['value'])) {
//                $this->assertContains($field['value'][0], $reports); TODO: buscar alternativa porque puede fallar en el caso que no se creen transacciones con el valor inicial y final
//                $this->assertContains($field['value'][1], $reports);
            } else {
                $this->assertContains($field['value'], $reports);
            }
        }
        $this->assertDatabaseCount('query_reports_view', 50);
    }

    public function fieldProvider(): array
    {
        return [
            'filter transactions by date' => [
                'filters' => [
                    [
                        'name' => 'created_at',
                        'table_name' => 'transactions',
                        'operator' => Fields::OPERATOR_BT,
                        'value' => ['2021-01-01', '2021-03-30']
                    ],
                    [
                        'name' => 'name',
                        'table_name' => 'merchants',
                        'operator' => Fields::OPERATOR_EQ,
                        'value' => ['Merchant 1']
                    ],
                ],
                'expectCount' => 30
            ],
            'filter transactions by purchase amount equals' => [
                'filters' => [
                    [
                        'name' => 'purchase_amount',
                        'table_name' => 'transactions',
                        'operator' => Fields::OPERATOR_EQ,
                        'value' => 10000
                    ],
                    [
                        'name' => 'name',
                        'table_name' => 'merchants',
                        'operator' => Fields::OPERATOR_EQ,
                        'value' => ['Merchant 1']
                    ],
                ],
                'expectCount' => 30
            ],
        ];
    }
}
