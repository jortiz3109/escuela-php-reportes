<?php

namespace Tests\Unit\Domain\Country\Projectors;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryProjector extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itMustStoreCountries(): void
    {
        Country::factory()->count(3)->make()->each(function ($paymentMethod) {
            Country::createWithAttributes($paymentMethod->toArray());
            $this->assertDatabaseHas('countries', $paymentMethod->toArray());
        });

        $this->assertDatabaseCount('countries', 3);
    }
}
