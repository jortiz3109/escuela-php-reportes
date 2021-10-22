<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MerchantFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Merchant::class;

    public function definition(): array
    {
        $countries = Country::all();
        $currencies = Currency::all();
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->unique()->name(),
            'url' => $this->faker->url(),
            'country_id' => $countries->isEmpty()? Country::factory()->create()->getKey() : $countries->random()->id,
            'currency_id' => $currencies->isEmpty()? Currency::factory()->create()->getKey() : $currencies->random()->id,
        ];
    }
}
