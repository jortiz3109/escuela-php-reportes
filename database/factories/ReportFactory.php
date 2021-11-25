<?php

namespace Database\Factories;

use App\Constants\Exports;
use App\Constants\ExportTypes;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(ExportTypes::EXPORTABLE_TYPES),
            'extension' => $this->faker->randomElement(Exports::TYPES),
        ];
    }
}
