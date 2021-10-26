<?php

namespace Domain\Merchant\Aggregates;

use App\Domain\Merchant\Aggregates\MerchantAggregate;
use App\Domain\Merchant\Events\MerchantCreated;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MerchantAggregateTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    private string $uuid;
    private array $attributes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->attributes = Merchant::factory()->definition();
        $this->uuid = $this->attributes['uuid'];
    }

    /**
     * @test
     */
    public function itMustFireOffEvent(): void
    {
        MerchantAggregate::fake()
            ->when(function (MerchantAggregate $aggregate) {
                $aggregate->createMerchant($this->uuid, $this->attributes);
            })
            ->assertRecorded(new MerchantCreated($this->attributes));
    }

    /**
     * @test
     */
    public function itMustStoreAMerchant(): void
    {
        MerchantAggregate::retrieve($this->uuid)->createMerchant($this->uuid, $this->attributes)->persist();

        $this->assertDatabaseHas('merchants', $this->attributes);
    }
}
