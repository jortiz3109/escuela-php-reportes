<?php

namespace Database\Factories;

use App\Constants\ExportTypes;
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
        $tableName = $this->faker->randomElement(ExportTypes::EXPORTABLE_TABLES);
        $name = $this->faker->randomElement(Fields::getFieldsByTable($tableName));
        return [
            'name' => $name,
            'table_name' => $tableName,
            'operator' => $this->faker->randomElement(Fields::OPERATORS),
            'value' => $this->faker->dateTime(),
            'report_id' => Report::factory(),
        ];
    }
}
