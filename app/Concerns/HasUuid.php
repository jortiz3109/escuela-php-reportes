<?php

namespace App\Concerns;

/**
 * @method static where(string $string, string $uuid)
 */
trait HasUuid
{
    public static function uuid(string $uuid): ?self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
