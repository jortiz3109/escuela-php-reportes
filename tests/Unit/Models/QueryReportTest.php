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
        $visa = PaymentMethod::factory()->create(['name' => 'Visa']);
        $masterCard = PaymentMethod::factory()->create(['name' => 'MasterCard']);
        $usd = Currency::factory()->create(['alphabetic_code' => 'USD']);
        $cop = Currency::factory()->create(['alphabetic_code' => 'COP']);
        $merchant1 = Merchant::factory()->create(['name' => 'Merchant 1']);
        $merchant2 = Merchant::factory()->create(['name' => 'Merchant 2']);
        $transactions1 = Transaction::factory(30)->create([
            'created_at' => $this->faker->dateTimeBetween('2021-01-01', '2021-03-30'),
            'purchase_amount' => $this->faker->numberBetween(1000, 20000),
            'payment_method_id' => $visa->id,
            'merchant_id' => $merchant1->id,
            'currency_id' => $usd->id,
        ]);
        $transactions2 = Transaction::factory(20)->create([
            'created_at' => $this->faker->dateTimeBetween('2021-04-01', '2021-06-30'),
            'purchase_amount' => 100000,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2->id,
            'currency_id' => $cop->id,
        ]);
    }

    /**
     * @test
     * @dataProvider fieldProvider
     */
    public function aClientCanToApplyFilterToReports($fields, $expectCount): void
    {
        $reports = QueryReport::filter($fields)->get();

        $this->assertTrue($reports->count(), $expectCount);

        foreach ($fields as $field) {
            $this->assertContains($field->value, $reports);
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
                    ]
                ],
                'expectCount' => 30
            ]
        ];
    }
}
