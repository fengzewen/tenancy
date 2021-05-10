<?php

namespace Xpsaas\Tenancy\Events\Database;

use Xpsaas\Tenancy\Abstracts\AbstractEvent;
use Xpsaas\Tenancy\Database\Connection;
use Xpsaas\Tenancy\Contracts\Website;

class ConfigurationLoading extends AbstractEvent
{
    /**
     * @var string
     */
    public $mode;

    /**
     * @var array
     */
    public $configuration;

    /**
     * @var Connection
     */
    public $connection;

    /**
     * @var Website
     */
    public $website;

    /**
     * @param string     $mode
     * @param array      $configuration
     * @param Connection $connection
     * @param Website    $website
     */
    public function __construct(string &$mode, array &$configuration, Connection &$connection, Website $website)
    {
        $this->mode = &$mode;
        $this->configuration = &$configuration;
        $this->connection = &$connection;
        $this->website = $website;
    }
}
