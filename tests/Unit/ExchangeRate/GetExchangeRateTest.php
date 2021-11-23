<?php

namespace Tests\Unit\ExchangeRate;

use App\Domain\ExchangeRate\Services\ExchangeRateService;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetExchangeRateTest extends TestCase
{
    use RefreshDatabase;

    private string $timezone = 'America/Bogota';

    private ExchangeRateService $exchangeRateService;

    public function setUp(): void
    {
        parent::setUp();

        $this->exchangeRateService = $this->app->make(ExchangeRateService::class);
    }

    /** @test */
    public function aResponseExchangesRateOnlyContainsInstanceOfExchangeRate()
    {
        $response = $this->exchangeRateService->get();

        $this->assertContainsOnlyInstancesOf(
            ExchangeRate::class,
            $response
        );
    }

    /** @test */
    public function aSyncOfExchangeRatesSaveInDatabase()
    {
        $this->exchangeRateService->sync();

        $this->assertDatabaseHas('exchange_rates', [
            'date' => Carbon::now()
                ->timezone($this->timezone)->format('Y-m-d'),
            'base' => 'USD',
            'currency' => 'USD',
            'rate' => 1,
        ]);
    }
}
