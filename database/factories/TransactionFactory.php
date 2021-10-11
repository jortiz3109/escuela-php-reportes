<?php

namespace Database\Factories;

use App\Constants\Transactions;
use App\Models\Buyer;
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
        return [
            'reference' => $this->faker->unique()->numerify('########'),
            'purchase_amount' => $this->faker->numberBetween(100000, 9999999),
            'platform_amount' => $this->faker->numberBetween(1000, 999999),
            'truncated_pan' => $this->faker->creditCardNumber(),
            'status' => $this->faker->randomElement(Transactions::STATUSES),
            'ip' => $this->faker->ipv4(),
            'device_id' => Device::factory(),
            'payer_id' => Payer::factory(),
            'buyer_id' => Buyer::factory(),
            'merchant_id' => Merchant::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'currency_id' => Currency::factory(),
        ];
    }
}
