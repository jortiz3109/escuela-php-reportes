<?php

namespace Tests\Unit\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Operators\Between;
use App\Filters\Operators\Equals;
use App\Filters\Operators\GreaterThan;
use App\Filters\Operators\GreaterThanOrEquals;
use App\Filters\Operators\LessThan;
use App\Filters\Operators\LessThanOrEquals;
use App\Filters\Operators\NullOperator;
use App\Filters\Operators\OperatorFactory;
use Tests\TestCase;

class OperatorFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider operatorProvider
     */
    public function factoryMustResolveCorrectOperatorClass(string|null $operator, string $class): void
    {
        $this->assertInstanceOf($class, OperatorFactory::make($operator));
    }

    public function operatorProvider(): array
    {
        return [
            'operator between' => [Fields::OPERATOR_BT, Between::class],
            'operator equals' => [Fields::OPERATOR_EQ, Equals::class],
            'operator less than' => [Fields::OPERATOR_LT, LessThan::class],
            'operator great than' => [Fields::OPERATOR_GT, GreaterThan::class],
            'operator less than or equals' => [Fields::OPERATOR_LEQ, LessThanOrEquals::class],
            'operator great than or equals' => [Fields::OPERATOR_GEQ, GreaterThanOrEquals::class],
            'operator null' => [null, NullOperator::class],
        ];
    }
}
