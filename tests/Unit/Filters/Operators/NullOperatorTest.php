<?php

namespace Tests\Unit\Filters\Operators;

use App\Filters\Operators\NullOperator;
use App\Models\QueryReport;
use Tests\TestCase;

class NullOperatorTest extends TestCase
{
    /**
     * @test
     */
    public function operatorMustReturnEmptySql(): void
    {
        $operator = new NullOperator();

        $query = $operator->apply(QueryReport::query(), 'transaction_create_at', null);

        $this->assertEquals(QueryReport::query()->toSql(), $query->toSql());
    }
}
