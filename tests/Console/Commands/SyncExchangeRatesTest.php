<?php

namespace Tests\Console\Commands;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncExchangeRatesTest extends TestCase
{
    use RefreshDatabase;

    private const COMMAND_NAME = 'exchange-rates:sync';

    /** @test */
    public function theCommandRunsSuccessfully()
    {
        $command = $this->artisan(self::COMMAND_NAME);

        $command->expectsOutput(Carbon::now() . ': Initializing sync currency exchanges rates')
            ->expectsOutput(Carbon::now() . ': Finalizing sync currency exchanges rates')
            ->assertExitCode(0);
    }

    /** @test */
    public function theCommandRunsSuccessfullyWithDate()
    {
        $command = $this->artisan(
            self::COMMAND_NAME,
            [
                'date' => Carbon::now()->format('Y-m-d'),
            ]
        );

        $command->expectsOutput(Carbon::now() . ': Initializing sync currency exchanges rates')
            ->expectsOutput(Carbon::now() . ': Finalizing sync currency exchanges rates')
            ->assertExitCode(0);
    }

    /** @test */
    public function theCommandRunsSuccessfullyScheduler()
    {
        $this->artisan(
            'schedule:run'
        )->assertExitCode(0);
    }

    /** @test */
    public function theCommandRunsSuccessfullyAndSyncInDatabase()
    {
        $command = $this->artisan(
            self::COMMAND_NAME,
            [
                'date' => Carbon::now()->format('Y-m-d'),
            ]
        );
        $command->execute();

        $this->assertDatabaseHas('exchange_rates', [
            'date' => Carbon::now()->format('Y-m-d'),
            'base' => 'USD',
            'currency' => 'USD',
            'rate' => 1,
        ]);
    }

    /** @test */
    public function theCommandRunsUnSuccessfullyWithErrorDateAndMissingInDatabase()
    {
        $command = $this->artisan(
            self::COMMAND_NAME,
            [
                'date' => '2020-20-20',
            ]
        );

        $command->execute();

        $this->assertDatabaseMissing('exchange_rates', [
            'date' => '2020-20-20',
            'base' => 'USD',
            'currency' => 'USD',
            'rate' => 1,
        ]);
    }
}
