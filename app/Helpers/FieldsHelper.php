<?php

namespace App\Helpers;

class FieldsHelper
{
    public static function getFieldsNames(array $fields): array
    {
        $columnFields = [];
        foreach ($fields as $field) {
            array_push($columnFields, self::getFieldName($field));
        }
        return $columnFields;
    }

    public static function getFieldName(array $field): string
    {
        return $field['table_name'] . '_' . $field['name'];
    }
}
