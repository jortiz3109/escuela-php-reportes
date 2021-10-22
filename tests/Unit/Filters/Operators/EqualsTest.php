<?php

namespace Tests\Unit\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Operators\Equals;
use App\Models\QueryReport;
use Tests\TestCase;

class EqualsTest extends TestCase
{
    /**
     * @test
     */
    public function operatorMustBeInQuerySQL(): void
    {
        $operator = new Equals();

        $query = $operator->apply(QueryReport::query(), 'transaction_create_at', '2020-01-01');

        $this->assertStringContainsString(Fields::OPERATOR_EQ, $query->toSql());
    }
}
