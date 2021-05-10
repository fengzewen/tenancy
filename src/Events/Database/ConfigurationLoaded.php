<?php


namespace Xpsaas\Tenancy\Events\Database;

use Xpsaas\Tenancy\Abstracts\AbstractEvent;
use Xpsaas\Tenancy\Database\Connection;
use Xpsaas\Tenancy\Contracts\Website;

class ConfigurationLoaded extends AbstractEvent
{
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
     * @param array      $configuration
     * @param Connection $connection
     * @param Website    $website
     */
    public function __construct(array &$configuration, Connection &$connection, Website $website)
    {
        $this->configuration = &$configuration;
        $this->connection = &$connection;
        $this->website = $website;
    }
}
