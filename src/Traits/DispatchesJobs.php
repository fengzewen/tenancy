<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://tenancy.dev
 * @see https://github.com/hyn/multi-tenant
 */

namespace Xpsaas\Tenancy\Traits;

use Xpsaas\Tenancy\Contracts\Bus\Dispatcher;

trait DispatchesJobs
{
    /**
     * @param $command
     * @param null $handler
     * @return mixed
     */
    public function dispatch($command, $handler = null)
    {
        return app(Dispatcher::class)->dispatchNow($command, $handler);
    }
}
