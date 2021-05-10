<?php


namespace Xpsaas\Tenancy\Traits;

use Xpsaas\Tenancy\Database\Connection;

trait UsesSystemConnection
{
    public function getConnectionName()
    {
        return app(Connection::class)->systemName();
    }
}
