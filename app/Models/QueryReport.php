<?php

namespace App\Models;

use App\Constants\Fields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryReport extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'query_reports_view';

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $selected = [];
        foreach ($filters as $filter){
            $columnName = $filter['table_name'] . '_' . $filter['name'];
            array_push($selected, $columnName);
            if($filter['operator'] === Fields::OPERATOR_BT) {
                $query->whereBetween($columnName, $filter['value']);
            } elseif($filter['operator'] !== null && $filter['value'] !== null) {
                $query->where($columnName, $filter['operator'], $filter['value']);
            }
        }
        $query->select($selected);
        return $query;
    }
}
