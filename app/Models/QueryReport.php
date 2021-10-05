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
        foreach ($filters as $filter){
            if($filter['operator'] === Fields::OPERATOR_BT) {
                $query->whereBetween($filter['table_name'] . '_' . $filter['name'], $filter['value']);
            } elseif($filter['operator'] !== null && $filter['value'] !== null) {
                $query->where($filter['table_name'] . '_' . $filter['name'], $filter['operator'], $filter['value']);
            }
        }
        return $query;
    }
}
