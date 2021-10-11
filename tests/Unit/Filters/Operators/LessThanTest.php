<?php

namespace Tests\Unit\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Operators\LessThan;
use App\Models\QueryReport;
use Tests\TestCase;

class LessThanTest extends TestCase
{
    /**
     * @test
     */
    public function operatorMustBeInQuerySQL(): void
    {
        $operator = new LessThan();

        $query = $operator->apply(QueryReport::query(), 'transaction_create_at', '2020-01-01');

        $this->assertStringContainsString(Fields::OPERATOR_LT, $query->toSql());
    }
}
