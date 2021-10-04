<?php

namespace Database\Factories;

use App\Constants\Devices;
use App\Constants\Transactions;
use App\Models\Buyer;
use App\Models\Currency;
use App\Models\Device;
use App\Models\Merchant;
use App\Models\Payer;
use App\Models\PaymentMethod;
use App\Models\QueryReport;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueryReportFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = QueryReport::class;

    public function definition(): array
    {
        return [
            'transactions_reference' => $this->faker->numerify('########'),
            'transactions_purchase_amount' => $this->faker->numberBetween(100000, 9999999),
            'transactions_platform_amount' => $this->faker->numberBetween(1000, 999999),
            'transactions_truncated_pan' => $this->faker->creditCardNumber(),
            'transactions_status' => $this->faker->randomElement(Transactions::STATUSES),
            'transactions_created_at' => $this->faker->dateTimeBetween('-1 years'),
            'transactions_ip' => $this->faker->ipv4(),
            'currencies_alphabetic_code' => Device::factory(),
            'merchants_name' => $this->faker->firstName(),
            'countries_alpha_3_code' => $this->faker->countryISOAlpha3(),
            'payers_name' => $this->faker->firstName(),
            'payers_email' => $this->faker->email(),
            'buyers_name' => $this->faker->firstName(),
            'buyers_email' =>  $this->faker->email(),
            'payment_methods_name' => $this->faker->creditCardType(),
            'devices_browser' => $this->faker->firefox(),
            'devices_os' => $this->faker->firefox(),
            'devices_device_type' => $this->faker->randomElement(Devices::TYPES),
        ];
    }
}
