<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Merchant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'url' => $this->faker->url(),
            'country_id' => Country::factory(),
            'currency_id' => Currency::factory(),
        ];
    }
}
