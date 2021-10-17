<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes)
 */
class Transaction extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public $guarded = [];
}
