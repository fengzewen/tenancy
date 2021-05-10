<?php

namespace Xpsaas\Tenancy\Abstracts;

use Xpsaas\Tenancy\Contracts\Website;

abstract class DatabaseEvent extends AbstractEvent
{
    /**
     * @var Website
     */
    public $website;

    /**
     * @var array
     */
    public $config;

    public function __construct(array &$config, Website $website = null)
    {
        $this->config = &$config;
        $this->website = &$website;
    }
}
