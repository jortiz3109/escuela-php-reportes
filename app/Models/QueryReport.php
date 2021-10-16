<?php

namespace App\Models;

use App\Filters\Filter;
use Database\Factories\QueryReportFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QueryReport
 * @method static Builder filter(array $filters)
 * @method static QueryReportFactory factory(...$parameters)
 */
class QueryReport extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'query_reports_view';

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $filter = new Filter($query, $filters);

        return $filter->buildQuery()->getBuilder();
    }
}
