<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class CountryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'numeric_code' => $this->faker->unique()->countryCode(),
            'alpha_3_code' => $this->faker->unique()->countryISOAlpha3(),
        ];
    }
}
