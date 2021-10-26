<?php

namespace App\Domain\Currency\Projectors;

use App\Domain\Currency\Events\CurrencyCreated;
use App\Models\Currency;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CurrencyProjector extends Projector
{
    public function onCountryCreated(CurrencyCreated $event): void
    {
        Currency::create([
            'uuid' => $event->attributes['uuid'],
            'alphabetic_code' => $event->attributes['alphabetic_code'],
            'numeric_code' => $event->attributes['numeric_code'],
            'minor_unit' => $event->attributes['minor_unit'],
        ]);
    }
}
