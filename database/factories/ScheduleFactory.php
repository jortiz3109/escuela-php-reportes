<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'minute' => $this->cronFormat(0, 60),
            'hour'=> $this->cronFormat(0, 23),
            'day_month' => $this->cronFormat(1, 30),
            'month' => $this->cronFormat(1, 12),
            'day_week' => $this->cronFormat(0, 6),
            'report_id' => Report::factory()->create(),
        ];

    }

    public function cronFormat($firstNumber, $lastNumber): string
    {
        return $this->faker->randomElement([
            $this->faker->numberBetween($firstNumber, $lastNumber),
            '*'
        ]);
    }
}
