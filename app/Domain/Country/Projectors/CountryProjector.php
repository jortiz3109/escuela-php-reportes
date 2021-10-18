<?php

namespace App\Domain\Country\Projectors;

use App\Domain\Country\Events\CountryCreated;
use App\Models\Country;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CountryProjector extends Projector
{
    public function onCountryCreated(CountryCreated $event)
    {
        Country::create($event->attributes);
    }
}
