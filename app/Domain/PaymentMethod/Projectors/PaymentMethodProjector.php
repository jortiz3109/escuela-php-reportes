<?php

namespace App\Domain\PaymentMethod\Projectors;

use App\Domain\PaymentMethod\Events\PaymentMethodCreated;
use App\Models\PaymentMethod;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class PaymentMethodProjector extends Projector
{
    public function onPaymentMethodCreated(PaymentMethodCreated $event): void
    {
        PaymentMethod::createWithAttributes(array_merge($event->attributes, ['created_at' => $event->attributes['created_at']]));
    }
}
