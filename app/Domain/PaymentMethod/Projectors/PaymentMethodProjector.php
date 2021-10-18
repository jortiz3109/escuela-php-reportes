<?php

namespace App\Domain\PaymentMethod\Projectors;

use App\Domain\PaymentMethod\Events\PaymentMethodCreated;
use App\Models\PaymentMethod;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class PaymentMethodProjector extends Projector
{
    public function onPaymentMethodCreated(PaymentMethodCreated $event): void
    {
        PaymentMethod::create([
            'uuid' => $event->attributes['uuid'],
            'name' => $event->attributes['name'],
        ]);
    }
}
