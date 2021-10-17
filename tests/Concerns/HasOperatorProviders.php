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
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_EQ, '2021-01-10 00:00:00'),
                ],
                'expectCount' => 20,
            ],
            'filter merchants by name equals Merchant 1' => [
                'filters' => [
                    $this->makeFilter('merchants', 'name', Fields::OPERATOR_EQ, 'Merchant 1'),
                ],
                'expectCount' => 22,
            ],
            'filter currencies by code equals USD' => [
                'filters' => [
                    $this->makeFilter('currencies', 'alphabetic_code', Fields::OPERATOR_EQ, 'USD'),
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
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_BT, ['2021-01-01 00:00:00', '2021-01-10 00:00:00']),
                ],
                'expectCount' => 30,
            ],
            'filter transactions by purchase_amount between 10000 and 20000' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_BT, [10000, 20000]),
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
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_GEQ, '2021-01-20 00:00:00'),
                ],
                'expectCount' => 12,
            ],
            'filter transactions by purchase_amount >= 20000' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_GEQ, 10000),
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
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_LEQ, '2021-01-01 00:00:00'),
                ],
                'expectCount' => 10,
            ],
            'filter transactions by purchase_amount <= 20000' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_LEQ, 20000),
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
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_BT, ['2021-01-01 00:00:00', '2021-01-10 00:00:00']),
                    $this->makeFilter('merchants', 'name', Fields::OPERATOR_EQ, 'Merchant 1'),
                    $this->makeFilter('currencies', 'alphabetic_code', Fields::OPERATOR_EQ, 'USD'),
                ],
                'expectCount' => 20,
            ],
            'filter transactions by date great or equals than 2021-01-10 00:00:00' => [
                'filters' => [
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_GEQ, '2021-01-10 00:00:00'),
                    $this->makeFilter('merchants', 'name', Fields::OPERATOR_EQ, 'Merchant 1'),
                    $this->makeFilter('currencies', 'alphabetic_code'),
                ],
                'expectCount' => 12,
            ],
            'filter transactions by purchase amount between' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_BT, [10000, 20000]),
                    $this->makeFilter('merchants', 'name', Fields::OPERATOR_EQ, 'Merchant 1'),
                    $this->makeFilter('payment_methods', 'name', Fields::OPERATOR_EQ, 'Mastercard'),
                    $this->makeFilter('currencies', 'alphabetic_code'),
                ],
                'expectCount' => 12,
            ],
            'filter merchants by currency code equals USD' => [
                'filters' => [
                    $this->makeFilter('merchants', 'name', Fields::OPERATOR_EQ, 'Merchant 1'),
                    $this->makeFilter('currencies', 'alphabetic_code', Fields::OPERATOR_EQ, 'USD'),
                    $this->makeFilter('countries', 'alpha_3_code'),
                    $this->makeFilter('payment_methods', 'name'),
                ],
                'expectCount' => 22,
            ],
            'filter transactions by currency code equals COL and purchase amount less or equals than 14999' => [
                'filters' => [
                    $this->makeFilter('currencies', 'alphabetic_code', Fields::OPERATOR_EQ, 'COP'),
                    $this->makeFilter('transactions', 'created_at'),
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_LEQ, 15000),
                ],
                'expectCount' => 10,
            ],
            'filter payment methods Visa' => [
                'filters' => [
                    $this->makeFilter('payment_methods', 'name', Fields::OPERATOR_EQ, 'Visa'),
                    $this->makeFilter('transactions', 'purchase_amount'),
                ],
                'expectCount' => 20,
            ],
        ];
    }

    public function operatorLTProvider(): array
    {
        return [
            'filter transactions by purchase amount less than 20000' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_LT, 20000),
                ],
                'expectCount' => 41,
            ],
            'filter transactions by date less than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_LT, '2021-01-10 00:00:00'),
                ],
                'expectCount' => 10,
            ],
        ];
    }

    public function operatorGTProvider(): array
    {
        return [
            'filter transactions by purchase amount great than 10000' => [
                'filters' => [
                    $this->makeFilter('transactions', 'purchase_amount', Fields::OPERATOR_GT, 10000),
                ],
                'expectCount' => 41,
            ],
            'filter transactions by date great than 2020-01-10' => [
                'filters' => [
                    $this->makeFilter('transactions', 'created_at', Fields::OPERATOR_GT, '2021-01-10 00:00:00'),
                ],
                'expectCount' => 12,
            ],
        ];
    }

    public function ascendingDataProvider(): array
    {
        return [
            'query merchants and transactions ordering data ascending by default' => [
                'filters' => [
                    $this->makeFilter('merchants', 'name'),
                    $this->makeFilter('transactions', 'purchase_amount'),
                    $this->makeFilter('transactions', 'platform_amount'),
                ],
            ],
        ];
    }

    public function descendingDataProvider(): array
    {
        return [
            'query merchants and transactions ordering data descending' => [
                'filters' => [
                    $this->makeFilter('merchants', 'name', null, null, 'desc'),
                    $this->makeFilter('transactions', 'purchase_amount', null, null, 'desc'),
                    $this->makeFilter('transactions', 'platform_amount', null, null, 'desc'),
                ],
            ],
        ];
    }

    public function makeFilter(
        string $tableName,
        string $name,
        ?string $operator = null,
        array|string|null $value = null,
        ?string $order = 'asc'
    ): array {
        return [
            'table_name' => $tableName,
            'name' => $name,
            'operator' => $operator,
            'value' => $value,
            'order' => $order,
        ];
    }
}
