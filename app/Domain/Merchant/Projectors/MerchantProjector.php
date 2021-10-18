<?php

namespace App\Domain\Merchant\Projectors;

use App\Domain\Merchant\Events\MerchantCreated;
use App\Models\Merchant;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class MerchantProjector extends Projector
{
    public function onMerchantCreated(MerchantCreated $event): void
    {
        Merchant::createWithAttributes($event->attributes);
    }
}
