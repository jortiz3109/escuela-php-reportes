<?php

namespace Database\Factories;

use App\Constants\ExportModels;
use App\Constants\Fields;
use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Field::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(Fields::all()),
            'table_name' => $this->faker->randomElement(ExportModels::EXPORTABLE_MODELS)
        ];
    }
}
