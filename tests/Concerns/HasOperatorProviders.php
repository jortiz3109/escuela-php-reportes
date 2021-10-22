<?php

namespace Tests\Concerns;

use App\Constants\Fields;

trait HasOperatorProviders
{
    public function operatorEQProvider(): array
    {
        return [
            'filter transactions by date equals' => [
                'filters' => [
                    $this->makeFilter('2021-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_EQ),
                ],
                'expectCount' => 20,
            ],
            'filter merchants by name equals Merchant 1' => [
                'filters' => [
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                ],
                'expectCount' => 22,
            ],
            'filter currencies by code equals USD' => [
                'filters' => [
                    $this->makeFilter('USD', 'currencies', 'alphabetic_code', Fields::OPERATOR_EQ),
                ],
                'expectCount' => 32,
            ],
        ];
    }

    public function operatorBTProvider(): array
    {
        return [
            'filter transactions by date with between operator' => [
                'filters' => [
                    $this->makeFilter(['2021-01-01 00:00:00', '2021-01-10 00:00:00'], 'transactions', 'created_at', Fields::OPERATOR_BT),
                ],
                'expectCount' => 30,
            ],
            'filter transactions by purchase_amount between 10000 and 20000' => [
                'filters' => [
                    $this->makeFilter([10000, 20000], 'transactions', 'purchase_amount', Fields::OPERATOR_BT),
                ],
                'expectCount' => 42,
            ],
        ];
    }

    public function operatorGEQProvider(): array
    {
        return [
            'filter transactions by date with date >= operator' => [
                'filters' => [
                    $this->makeFilter('2021-01-20 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_GEQ),
                ],
                'expectCount' => 12,
            ],
            'filter transactions by purchase_amount >= 20000' => [
                'filters' => [
                    $this->makeFilter(10000, 'transactions', 'purchase_amount', Fields::OPERATOR_GEQ),
                ],
                'expectCount' => 42,
            ],
        ];
    }

    public function operatorLEQProvider(): array
    {
        return [
            'filter transactions by date with date <= operator' => [
                'filters' => [
                    $this->makeFilter('2021-01-01 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_LEQ),
                ],
                'expectCount' => 10,
            ],
            'filter transactions by purchase_amount <= 20000' => [
                'filters' => [
                    $this->makeFilter(20000, 'transactions', 'purchase_amount', Fields::OPERATOR_LEQ),
                ],
                'expectCount' => 42,
            ],
        ];
    }

    public function operatorsProvider(): array
    {
        return [
            'filter transactions by date between' => [
                'filters' => [
                    $this->makeFilter(['2021-01-01 00:00:00', '2021-01-10 00:00:00'], 'transactions', 'created_at', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('USD', 'currencies', 'alphabetic_code', Fields::OPERATOR_EQ),
                ],
                'expectCount' => 20,
            ],
            'filter transactions by date great or equals than 2021-01-10 00:00:00' => [
                'filters' => [
                    $this->makeFilter('2021-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_GEQ),
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'currencies', 'alphabetic_code'),
                ],
                'expectCount' => 12,
            ],
            'filter transactions by purchase amount between' => [
                'filters' => [
                    $this->makeFilter([10000, 20000], 'transactions', 'purchase_amount', Fields::OPERATOR_BT),
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('Mastercard', 'payment_methods', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'currencies', 'alphabetic_code'),
                ],
                'expectCount' => 12,
            ],
            'filter merchants by currency code equals USD' => [
                'filters' => [
                    $this->makeFilter('Merchant 1', 'merchants', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter('USD', 'currencies', 'alphabetic_code', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'countries', 'alpha_3_code'),
                    $this->makeFilter(null, 'payment_methods', 'name'),
                ],
                'expectCount' => 22,
            ],
            'filter transactions by currency code equals COL and purchase amount less or equals than 14999' => [
                'filters' => [
                    $this->makeFilter('COP', 'currencies', 'alphabetic_code', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'transactions', 'created_at'),
                    $this->makeFilter(15000, 'transactions', 'purchase_amount', Fields::OPERATOR_LEQ),
                ],
                'expectCount' => 10,
            ],
            'filter payment methods Visa' => [
                'filters' => [
                    $this->makeFilter('Visa', 'payment_methods', 'name', Fields::OPERATOR_EQ),
                    $this->makeFilter(null, 'transactions', 'purchase_amount'),
                ],
                'expectCount' => 20,
            ],
        ];
    }

    public function operatorLTProvider(): array
    {
        return [
            'filter transactions by currency code equals COL and purchase amount less than 20000' => [
                'filters' => [
                    $this->makeFilter(20000, 'transactions', 'purchase_amount', Fields::OPERATOR_LT),
                ],
                'expectCount' => 41,
            ],
            'filter transactions by date less than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('2021-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_LT),
                ],
                'expectCount' => 10,
            ],
        ];
    }

    public function operatorGTProvider(): array
    {
        return [
            'filter transactions by currency code equals COL and purchase amount great than 10000' => [
                'filters' => [
                    $this->makeFilter(10000, 'transactions', 'purchase_amount', Fields::OPERATOR_GT),
                ],
                'expectCount' => 41,
            ],
            'filter transactions by date great than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('2021-01-10 00:00:00', 'transactions', 'created_at', Fields::OPERATOR_GT),
                ],
                'expectCount' => 12,
            ],
        ];
    }

    public function fieldsProvider(): array
    {
        return [
            'fields are ordered in same order that is sent' => [
                'filters' => [
                    $this->makeFilter(null, 'transactions', 'reference'),
                    $this->makeFilter(null, 'transactions', 'created_at'),
                    $this->makeFilter(null, 'merchants', 'name'),
                ],
            ],
        ];
    }

    public function makeFilter(array|string|null $value, string $tableName, string $name, ?string $operator = null): array
    {
        return [
            'name' => $name,
            'table_name' => $tableName,
            'operator' => $operator,
            'value' => $value,
        ];
    }
}
