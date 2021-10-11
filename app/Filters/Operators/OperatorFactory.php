<?php

namespace App\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Contracts\FilterContract;

class OperatorFactory
{
    public const OPERATORS = [
        Fields::OPERATOR_EQ => Equals::class,
        Fields::OPERATOR_BT => Between::class,
        Fields::OPERATOR_LEQ => LessThanOrEquals::class,
        Fields::OPERATOR_GEQ => GreaterThanOrEquals::class,
        Fields::OPERATOR_LT => LessThan::class,
        Fields::OPERATOR_GT => GreaterThan::class,
    ];

    public static function make(string|null $operator): FilterContract
    {
        $classOperator = self::OPERATORS[$operator] ?? NullOperator::class;

        return new $classOperator;
    }
}
