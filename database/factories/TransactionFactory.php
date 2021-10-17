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
use Illuminate\Support\Str;


class TransactionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Transaction::class;

    public function definition(): array
    {
        $devices = Device::all();
        $payers = Payer::all();
        $buyers = Buyer::all();
        $merchants = Merchant::all();
        $paymentMethods = PaymentMethod::all();
        $currencies = Currency::all();
        $countries = Country::all();
        return [
            'uuid' => Str::uuid(),
            'reference' => $this->faker->unique()->numerify('########'),
            'purchase_amount' => $this->faker->numberBetween(100000, 9999999),
            'platform_amount' => $this->faker->numberBetween(1000, 999999),
            'truncated_pan' => $this->faker->creditCardNumber(),
            'status' => $this->faker->randomElement(Transactions::STATUSES),
            'ip' => $this->faker->ipv4(),
            'device_uuid' => $devices->isEmpty()? Device::factory()->create()->uuid : $devices->random()->uuid,
            'payer_uuid' => $payers->isEmpty()? Payer::factory()->create()->uuid : $payers->random()->uuid,
            'buyer_uuid' => $buyers->isEmpty()? Buyer::factory()->create()->uuid : $buyers->random()->uuid,
            'merchant_uuid' => $merchants->isEmpty()? Merchant::factory()->create()->uuid : $merchants->random()->uuid,
            'payment_method_uuid' => $paymentMethods->isEmpty()? PaymentMethod::factory()->create()->uuid : $paymentMethods->random()->uuid,
            'currency_uuid' => $currencies->isEmpty()? Currency::factory()->create()->uuid : $currencies->random()->uuid,
            'country_uuid' => $countries->isEmpty()? Country::factory()->create()->uuid : $countries->random()->uuid,
        ];
    }
}
