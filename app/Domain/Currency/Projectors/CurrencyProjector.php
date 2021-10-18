<?php

namespace App\Domain\Currency\Projectors;

use App\Domain\Currency\Events\CurrencyCreated;
use App\Models\Currency;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CurrencyProjector extends Projector
{
    public function onCountryCreated(CurrencyCreated $event)
    {
        Currency::create($event->attributes);
    }
}
