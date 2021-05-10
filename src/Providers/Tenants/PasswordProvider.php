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

namespace Xpsaas\Tenancy\Providers\Tenants;

use Xpsaas\Tenancy\Contracts\Database\PasswordGenerator;
use Xpsaas\Tenancy\Exceptions\GeneratorInvalidException;
use Illuminate\Support\ServiceProvider;

class PasswordProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PasswordGenerator::class, function ($app) {
            $generator = $app['config']->get('tenancy.db.password-generator');

            if (class_exists($generator)) {
                return $app->make($generator);
            }

            throw new GeneratorInvalidException($generator);
        });
    }
}
