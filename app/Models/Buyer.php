<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 */
class Buyer extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public function createWithAttributes(): static
    {
        
    }
}
