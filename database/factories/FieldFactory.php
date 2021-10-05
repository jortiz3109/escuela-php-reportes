<?php

namespace Database\Factories;

use App\Constants\ExportModels;
use App\Constants\Fields;
use App\Models\Field;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Field::class;

    public function definition(): array
    {
        $tableName = $this->faker->randomElement(array_keys(ExportModels::EXPORTABLE_MODELS));
        $name = $this->faker->randomElement(Fields::getFieldsByTable($tableName));
        return [
            'name' => $name,
            'table_name' => $tableName,
            'priority' => $this->faker->numberBetween(0, 30),
            'order' => $this->faker->randomElement([Fields::ORDER_ASC, Fields::ORDER_DESC]),
            'operator' => $this->faker->randomElement(Fields::OPERATORS),
            'value' => $this->faker->dateTime(),
            'report_id' => Report::factory(),
        ];
    }
}
