<?php

namespace Xpsaas\Tenancy\Abstracts;

use Xpsaas\Tenancy\Contracts\Hostname;

abstract class HostnameEvent extends AbstractEvent
{
    /**
     * @var Hostname
     */
    public $hostname;

    public function __construct(Hostname &$hostname = null)
    {
        $this->hostname = &$hostname;
    }
}
