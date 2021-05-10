<?php


namespace Xpsaas\Tenancy\Traits;

use Xpsaas\Tenancy\Database\Connection;

trait UsesTenantConnection
{
    public function getConnectionName()
    {
        return app(Connection::class)->tenantName();
    }
}
