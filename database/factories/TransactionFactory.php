<?php

namespace Database\Factories;

use App\Constants\Transactions;
use App\Models\Buyer;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Device;
use App\Models\Merchant;
use App\Models\Payer;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Transaction::class;

    public function definition(): array
    {
        $merchants = Merchant::all();
        $paymentMethods = PaymentMethod::all();
        $currencies = Currency::all();
        $countries = Country::all();
        return [
            'uuid' => $this->faker->uuid(),
            'reference' => $this->faker->unique()->numerify('########'),
            'purchase_amount' => $this->faker->numberBetween(100000, 9999999),
            'platform_amount' => $this->faker->numberBetween(1000, 999999),
            'truncated_pan' => $this->faker->creditCardNumber(),
            'status' => $this->faker->randomElement(Transactions::STATUSES),
            'ip' => $this->faker->ipv4(),
            'device_id' => Device::factory()->create()->getKey(),
            'payer_id' => Payer::factory()->create()->getKey(),
            'buyer_id' => Buyer::factory()->create()->getKey(),
            'merchant_id' => $merchants->isEmpty() ? Merchant::factory()->create()->getKey() : $merchants->random()->id,
            'payment_method_id' => $paymentMethods->isEmpty() ? PaymentMethod::factory()->create()->getKey() : $paymentMethods->random()->id,
            'currency_id' => $currencies->isEmpty() ? Currency::factory()->create()->getKey() : $currencies->random()->id,
            'country_id' => $countries->isEmpty() ? Country::factory()->create()->getKey() : $countries->random()->id,
        ];
    }
}
