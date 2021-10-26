<?php

namespace Tests\Unit\Domain\PaymentMethod\Projectors;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodProjectorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itMustStorePaymentMethod(): void
    {
        PaymentMethod::factory()->count(3)->make()->each(function ($paymentMethod) {
            PaymentMethod::createWithAttributes($paymentMethod->toArray());
            $this->assertDatabaseHas('payment_methods', $paymentMethod->toArray());
        });

        $this->assertDatabaseCount('payment_methods', 3);
    }
}
