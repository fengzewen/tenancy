<?php

namespace Xpsaas\Tenancy;

use Xpsaas\Tenancy\Contracts\CurrentHostname;
use Xpsaas\Tenancy\Contracts\Hostname;
use Xpsaas\Tenancy\Contracts\Tenant;
use Xpsaas\Tenancy\Contracts\Website;
use Xpsaas\Tenancy\Database\Connection;
use Xpsaas\Tenancy\Events;
use Xpsaas\Tenancy\Jobs\HostnameIdentification;
use Xpsaas\Tenancy\Traits\DispatchesEvents;
use Xpsaas\Tenancy\Traits\DispatchesJobs;
use Illuminate\Support\Traits\Macroable;
use Laravel\Lumen\Application;

class Environment
{
    use DispatchesJobs, DispatchesEvents, Macroable;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var bool
     */
    protected $installed;

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->defaults();

        if ((! $app->runningInConsole() || $app->runningUnitTests()) &&
            $this->installed() &&
            config('tenancy.hostname.auto-identification')) {
            $this->identifyHostname();
            // Identifies the current hostname, sets the binding using the native resolving strategy.
            $app->make(CurrentHostname::class);
        }
    }

    public function installed(): bool
    {
        $isInstalled = function (): bool {
            /** @var \Illuminate\Database\Connection $connection */
            $connection = $this->app->make(Connection::class)->system();

            /** @var string $table */
            $table = $this->app->make(Website::class)->getTable();

            try {
                $tableExists = $connection->getSchemaBuilder()->hasTable($table);
            }catch (\Exception $e) {
                print_r($e->getMessage());
            } finally {
                return $tableExists ?? false;
            }
        };

        return $this->installed ?? $this->installed = $isInstalled();
    }

    public function identifyHostname()
    {
        $this->app->singleton(CurrentHostname::class, function () {
            /** @var Hostname $hostname */
            $hostname = $this->dispatch(new HostnameIdentification());

            $this->tenant(optional($hostname)->website);

            return $hostname;
        });
    }

    /**
     * Get or set the current hostname.
     *
     * @param Hostname|null $hostname
     * @return Hostname|null
     */
    public function hostname(Hostname $hostname = null): ?Hostname
    {
        if ($hostname !== null) {
            $this->app->instance(CurrentHostname::class, $hostname);

            $this->emitEvent(new Events\Hostnames\Switched($hostname));

            return $hostname;
        }

        return $this->app->make(CurrentHostname::class);
    }

    public function website(): ?Website
    {
        $hostname = $this->hostname();

        return $hostname ? $hostname->website : null;
    }

    /**
     * Get or set current tenant.
     *
     * @param Website|null $website
     * @return Tenant|null
     */
    public function tenant(Website $website = null): ?Website
    {
        if ($website !== null) {
            $this->app->instance(Tenant::class, $website);

            $this->emitEvent(new Events\Websites\Switched($website));

            return $website;
        }

        return $this->app->make(Tenant::class);
    }

    protected function defaults()
    {
        $empty = function () {
            return null;
        };

        $this->app->singleton(Tenant::class, $empty);
        $this->app->singleton(CurrentHostname::class, $empty);
    }
}
