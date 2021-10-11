<?php

namespace Tests\Unit\Filters\Operators;

use App\Constants\Fields;
use App\Filters\Operators\Between;
use App\Models\QueryReport;
use Tests\TestCase;

class BetweenTest extends TestCase
{
    /**
     * @test
     */
    public function operatorMustBeInQuerySQL(): void
    {
        $operator = new Between();

        $query = $operator->apply(QueryReport::query(), 'transaction_create_at', ['2020-01-01', '2021-01-01']);

        $this->assertStringContainsString(Fields::OPERATOR_BT, $query->toSql());
    }
}
