<?php

namespace App\Concerns;

/**
 * @method static where(string $string, string $uuid)
 */
trait HasUuid
{
    public static function getByUuid(string $uuid): ?self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
