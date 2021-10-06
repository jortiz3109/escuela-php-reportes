<?php

namespace Tests\Concerns;

use App\Constants\Fields;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\Transaction;

trait HasOperatorProviders
{
    public function operatorsProvider(): array
    {
        return [
            'filter transactions by date between' => [
                'filters' => [
                    $this->makeFilter(['2020-01-01 00:00:00', '2021-01-10 00:00:00'], 'transactions', 'created_at', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 0', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('USD', 'currencies','alphabetic_code',  Fields::OPERATOR_EQ),
                ],
                'expectCount' => 19
            ],
            'filter transactions by date great or equals than 2020-01-10 00:00:00' => [
                'filters' => [
                    $this->makeFilter('2020-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_GEQ),
                    $this->makeFilter('Merchant 0', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'currencies','alphabetic_code'),
                ],
                'expectCount' => 9
            ],
            'filter transactions by purchase amount between' => [
                'filters' => [
                    $this->makeFilter([9999, 20000], 'transactions', 'purchase_amount', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('Mastercard', 'payment_methods', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'currencies','alphabetic_code'),
                ],
                'expectCount' => 11
            ],
            'filter merchants by currency code equals USD' => [
                'filters' => [
                    $this->makeFilter('Merchant 0', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('USD', 'currencies', 'alphabetic_code', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'countries','alpha_2_code'),
                    $this->makeFilter(null, 'payment_methods', 'name'),
                ],
                'expectCount' => 19
            ],
            'filter transactions by currency code equals COL and purchase amount less or equals than 14999' => [
                'filters' => [
                    $this->makeFilter('COP', 'currencies','alphabetic_code',  Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'transactions', 'created_at'),
                    $this->makeFilter(14999, 'transactions', 'purchase_amount', Fields::OPERATOR_LEQ),
                ],
                'expectCount' => 9
            ],
            'filter payment methods Visa' => [
                'filters' => [
                    $this->makeFilter('Visa', 'payment_methods', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null,'transactions', 'purchase_amount'),
                ],
                'expectCount' => 19
            ],
        ];
    }

    public function operatorLTProvider(): array
    {
        return [
            'filter transactions by currency code equals COL and purchase amount less than 14999' => [
                'filters' => [
                    $this->makeFilter(14999, 'transactions', 'purchase_amount', Fields::OPERATOR_LT),
                    $this->makeFilter(null, 'countries','alpha_2_code'),
                    $this->makeFilter(null, 'transactions', 'created_at'),
                ]
            ],
            'filter transactions by date less than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('2020-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_LT),
                    $this->makeFilter(null, 'currencies','alphabetic_code'),
                    $this->makeFilter(null, 'countries','alpha_2_code'),
                ],
            ],
        ];
    }

    public function operatorGTProvider(): array
    {
        return [
            'filter transactions by currency code equals COL and purchase amount great than 14999' => [
                'filters' => [
                    $this->makeFilter(14999, 'transactions', 'purchase_amount', Fields::OPERATOR_GT),
                    $this->makeFilter(null, 'countries','alpha_2_code'),
                    $this->makeFilter(null, 'transactions', 'created_at'),
                ]
            ],
            'filter transactions by date great than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('2020-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_GT),
                    $this->makeFilter(null, 'currencies','alphabetic_code'),
                    $this->makeFilter(null, 'countries','alpha_2_code'),
                ],
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

    private function makeDataToQuery(): void
    {
        $usd = Currency::factory()->create(['alphabetic_code' => 'USD']);
        $cop = Currency::factory()->create(['alphabetic_code' => 'COP']);
        $visa = PaymentMethod::factory()->create(['name' => 'Visa']);
        $masterCard = PaymentMethod::factory()->create(['name' => 'Mastercard']);
        $merchant1 = Merchant::factory()->create(['name' => 'Merchant 1']);
        $merchant2 = Merchant::factory()->create(['name' => 'Merchant 2']);
        Transaction::factory(10)->create([
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
        Transaction::factory(10)->create([
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
        Transaction::factory(10)->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => rand(10000, 20000),
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2,
        ]);
    }
}
