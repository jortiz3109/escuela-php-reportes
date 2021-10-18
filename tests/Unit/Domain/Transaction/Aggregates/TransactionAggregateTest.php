<?php

namespace Tests\Unit\Domain\Transaction\Aggregates;

use App\Domain\Transaction\Aggregates\TransactionAggregate;
use App\Domain\Transaction\Events\TransactionAdded;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionAggregateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private string $uuid;
    private array $attributes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->attributes = Transaction::factory()->definition();
        $this->uuid = $this->attributes['uuid'];
    }
    /**
     * @test
     */
    public function itMustFireOffEventTransactionAdded(): void
    {
        TransactionAggregate::fake()
            ->when(function (TransactionAggregate $aggregate) {
                $aggregate->addTransaction($this->uuid, $this->attributes);
            })
            ->assertRecorded(new TransactionAdded($this->attributes));
    }

    /**
     * @test
     */
    public function itMustStoreATransaction(): void
    {
        TransactionAggregate::retrieve($this->uuid)->addTransaction($this->uuid, $this->attributes)->persist();

        $this->assertDatabaseHas('transactions', $this->attributes);
        $this->assertDatabaseCount('query_reports_view', 1);
    }
}
