<?php


namespace Xpsaas\Tenancy\Traits;

use Xpsaas\Tenancy\Abstracts\AbstractEvent;
use Illuminate\Contracts\Events\Dispatcher;

trait DispatchesEvents
{
    /**
     * @param AbstractEvent $event
     * @param array $payload
     * @return array|null
     */
    public function emitEvent(AbstractEvent $event, array $payload = [])
    {
        return app(Dispatcher::class)->dispatch($event, $payload);
    }
}
