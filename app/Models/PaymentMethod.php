<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 */
class PaymentMethod extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
}
