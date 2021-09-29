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

    public const OPERATORS = [
        self::OPERATOR_EQ,
        self::OPERATOR_GEQ,
        self::OPERATOR_LEQ,
        self::OPERATOR_GT,
        self::OPERATOR_LT,
        self::OPERATOR_DT,
    ];
}
