<?php

namespace Tests\Unit\Models;

use App\Constants\ExportModels;
use App\Constants\Fields;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\QueryReport;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QueryReportTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     * @dataProvider fieldProvider
     */
    public function aClientCanToApplyFilterToReports(array $fields, int $expectCount): void
    {
        $usd = Currency::factory()->create(['alphabetic_code' => 'USD']);
        $cop = Currency::factory()->create(['alphabetic_code' => 'COP']);
        $visa = PaymentMethod::factory()->create(['name' => 'Visa']);
        $masterCard = PaymentMethod::factory()->create(['name' => 'Mastercard']);
        $merchant1 = Merchant::factory()->create(['name' => 'Merchant 1']);
        $merchant2 = Merchant::factory()->create(['name' => 'Merchant 2']);
        Transaction::factory(20)->create([
            'created_at' => '2021-01-01',
            'purchase_amount' => 15000,
            'currency_id' => $usd->id,
            'payment_method_id' => $visa->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory(10)->create([
            'created_at' => '2021-01-10',
            'purchase_amount' => rand(10000, 20000),
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory(20)->create([
            'created_at' => '2021-01-10',
            'purchase_amount' => 15000,
            'currency_id' => $cop->id,
            'payment_method_id' => $visa->id,
            'merchant_id' => $merchant2,
        ]);
        Transaction::factory()->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => 10000,
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2,
        ]);
        Transaction::factory()->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => 20000,
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2,
        ]);
        Transaction::factory(20)->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => rand(10000, 20000),
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2,
        ]);
        $reports = QueryReport::filter($fields)->get()->toArray();

        $this->assertCount($expectCount, $reports);

       foreach ($fields as $field) {
            if(is_array($field['value'])) {
                $this->assertNotFalse(array_search($field['value'][0], array_column($reports, $field['table_name'] . '_' . $field['name'])));
                $this->assertNotFalse(array_search($field['value'][1], array_column($reports, $field['table_name'] . '_' . $field['name'])));
            } elseif($field['value'] !== null) {
                $this->assertNotFalse(array_search($field['value'], array_column($reports, $field['table_name'] . '_' . $field['name'])));
            }
        }
        $this->assertDatabaseCount('query_reports_view', 72);
    }

    public function fieldProvider(): array
    {
        return [
            'filter transactions by date' => [
                'filters' => [
                    $this->makeFilter(['2021-01-01 00:00:00', '2021-01-10 00:00:00'], 'transactions', 'created_at', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('USD', 'currencies','alphabetic_code',  Fields::OPERATOR_EQ),
                ],
                'expectCount' => 30
            ],
            'filter transactions by purchase amount between' => [
                'filters' => [
                    $this->makeFilter([10000, 20000], 'transactions', 'purchase_amount', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 2', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('Mastercard', 'payment_methods', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'currencies','alphabetic_code'),
                    ],
                'expectCount' => 22
            ],
        ];
    }

    public function makeFilter($value, string $tableName, string $name, ?string $operator = null): array
    {
        return [
            'name' => $name,
            'table_name' => $tableName,
            'operator' => $operator,
            'value' => $value
        ];
    }
}
