<?php

namespace Xpsaas\Tenancy\Abstracts;

abstract class AbstractEvent
{
    public $reason;

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason(string $reason)
    {
        $this->reason = $reason;

        return $this;
    }
}
