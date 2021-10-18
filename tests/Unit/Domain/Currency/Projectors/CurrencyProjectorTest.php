<?php

namespace Tests\Unit\Domain\Currency\Projectors;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyProjectorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itMustStoreCurrency(): void
    {
        Currency::factory()->count(3)->make()->each(function ($paymentMethod) {
            Currency::createWithAttributes($paymentMethod->toArray());
            $this->assertDatabaseHas('currencies', $paymentMethod->toArray());
        });

        $this->assertDatabaseCount('currencies', 3);
    }
}
