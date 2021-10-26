<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Currency::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'alphabetic_code' => $this->faker->unique()->currencyCode(),
            'numeric_code' => $this->faker->unique()->numerify(),
            'minor_unit' => $this->faker->numberBetween(0, 3),
        ];
    }
}
