<?php

namespace App\Domain\Country\Projectors;

use App\Domain\Country\Events\CountryCreated;
use App\Models\Country;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CountryProjector extends Projector
{
    public function onCountryCreated(CountryCreated $event): void
    {
        Country::create([
            'uuid' => $event->attributes['uuid'],
            'numeric_code' => $event->attributes['numeric_code'],
            'alpha_3_code' => $event->attributes['alpha_3_code'],
        ]);
    }
}
