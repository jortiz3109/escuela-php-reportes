<?php

namespace Database\Factories;

use App\Models\Payer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayerFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Payer::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
        ];
    }
}
