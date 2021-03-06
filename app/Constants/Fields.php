<?php

namespace App\Constants;

class Fields
{
    public const ORDER_ASC = 'asc';
    public const ORDER_DESC = 'desc';
    public const OPERATOR_EQ = '=';
    public const OPERATOR_LEQ = '<=';
    public const OPERATOR_GEQ = '>=';
    public const OPERATOR_LT = '<';
    public const OPERATOR_GT = '>';
    public const OPERATOR_BT = 'between';

    public const OPERATORS = [
        self::OPERATOR_EQ,
        self::OPERATOR_GEQ,
        self::OPERATOR_LEQ,
        self::OPERATOR_GT,
        self::OPERATOR_LT,
        self::OPERATOR_BT,
    ];

    public const TRANSACTION_FIELDS = [
        'reference',
        'purchase_amount',
        'platform_amount',
        'truncated_pan',
        'status',
        'ip',
    ];

    public const MERCHANT_FIELDS = [
        'name',
        'url',
    ];

    public const DEVICE_FIELDS = [
        'browser',
        'os',
        'device_type',
    ];

    public const PAYMENT_METHOD_FIELDS = [
        'name',
    ];

    public const BUYER_FIELDS = [
        'name',
        'email',
    ];

    public const PAYER_FIELDS = [
        'name',
        'email',
    ];

    public const COUNTRY_FIELDS = [
        'numeric_code',
        'alpha_3_code',
    ];

    public const CURRENCY_FIELDS = [
        'numeric_code',
        'alphabetic_code',
        'minor_unit',
    ];

    public const FIELDS_BY_TABLE = [
        'transactions' => self::TRANSACTION_FIELDS,
        'merchants' => self::MERCHANT_FIELDS,
        'currencies' => self::CURRENCY_FIELDS,
        'countries' => self::COUNTRY_FIELDS,
        'payment_methods' => self::PAYMENT_METHOD_FIELDS,
        'payers' => self::PAYER_FIELDS,
        'buyers' => self::BUYER_FIELDS,
        'devices' => self::DEVICE_FIELDS,
    ];

    public static function getFieldsByTable(string $tableName): array
    {
        return self::FIELDS_BY_TABLE[$tableName];
    }
}
