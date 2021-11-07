<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
