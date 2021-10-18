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
            'country_uuid' => $countries->isEmpty()? Country::factory()->create()->getAttribute('uuid') : $countries->random()->uuid,
            'currency_uuid' => $currencies->isEmpty()? Currency::factory()->create()->getAttribute('uuid') : $currencies->random()->uuid,
        ];
    }
}
