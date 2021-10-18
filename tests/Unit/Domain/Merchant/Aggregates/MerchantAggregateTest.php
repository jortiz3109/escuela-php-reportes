<?php

namespace Domain\Merchant\Aggregates;

use App\Domain\Merchant\Aggregates\MerchantAggregate;
use App\Domain\Merchant\Events\MerchantCreated;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
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
        $this->uuid = Uuid::uuid4();
        $this->attributes = [
            'uuid' => $this->uuid,
            'name' => $this->faker->domainName(),
            'url' => $this->faker->url(),
            'country_uuid' => Country::factory()->create()->getAttribute('uuid'),
            'currency_uuid' => Currency::factory()->create()->getAttribute('uuid'),
        ];
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
