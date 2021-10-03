<?php

namespace App\Constants;

class Fields
{
    public const ORDER_ASC = 'acs';
    public const ORDER_DESC = 'desc';
    public const OPERATOR_EQ = '=';
    public const OPERATOR_LEQ = '<=';
    public const OPERATOR_GEQ = '>=';
    public const OPERATOR_LT = '<';
    public const OPERATOR_GT = '>';
    public const OPERATOR_DT = '!=';
    public const OPERATOR_BT = 'BETWEEN';

    public const OPERATORS = [
        self::OPERATOR_EQ,
        self::OPERATOR_GEQ,
        self::OPERATOR_LEQ,
        self::OPERATOR_GT,
        self::OPERATOR_LT,
        self::OPERATOR_DT,
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

    public static  function all(): array
    {
        return array_unique(
            array_merge(
                self::TRANSACTION_FIELDS,
                self::MERCHANT_FIELDS,
                self::DEVICE_FIELDS,
                self::COUNTRY_FIELDS,
                self::CURRENCY_FIELDS,
                self::PAYER_FIELDS,
                self::BUYER_FIELDS,
                self::PAYMENT_METHOD_FIELDS,
            ), SORT_REGULAR
        );
    }
}
