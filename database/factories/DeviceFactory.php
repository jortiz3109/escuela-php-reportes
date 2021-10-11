<?php

namespace Database\Factories;

use App\Constants\Devices;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Device::class;

    public function definition(): array
    {
        return [
            'browser' => $this->faker->firstName(),
            'os' => $this->faker->randomElement(['Android', 'IOS', 'Windows', 'Linux']),
            'device_type' => $this->faker->randomElement(Devices::TYPES),
        ];
    }
}
