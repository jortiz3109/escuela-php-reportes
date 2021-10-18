<?php

namespace Tests\Unit\Domain\Transaction\Aggregates;


use App\Constants\Transactions;
use App\Domain\Transaction\Aggregates\TransactionAggregate;
use App\Domain\Transaction\Events\TransactionAdded;
use App\Models\Buyer;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Device;
use App\Models\Merchant;
use App\Models\Payer;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
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
        $a = Device::all();
//        Merchant::factory()->create(['uuid' => $this->attributes['merchant_uuid']]);
//        PaymentMethod::factory()->create(['uuid' => $this->attributes['payment_method_uuid']]);
//        Currency::factory()->create(['uuid' => $this->attributes['currency_uuid']]);
//        Country::factory()->create(['uuid' => $this->attributes['country_uuid']]);

        TransactionAggregate::retrieve($this->uuid)->addTransaction($this->uuid, $this->attributes)->persist();

        $this->assertDatabaseHas('transactions', $this->attributes);
        $this->assertDatabaseCount('query_reports_view', 1);
    }
}
