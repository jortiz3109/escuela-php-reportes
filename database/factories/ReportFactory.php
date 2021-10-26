<?php

namespace Database\Factories;

use App\Constants\ExportModels;
use App\Constants\Exports;
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
            'model' => str_replace('\\', '', $this->faker->randomElement(ExportModels::EXPORTABLE_MODELS)),
            'extension' => $this->faker->randomElement(Exports::TYPES),
        ];
    }
}
