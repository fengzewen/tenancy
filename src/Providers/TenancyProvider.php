<?php
namespace Xpsaas\Tenancy\Providers;

use Xpsaas\Tenancy\Contracts;
use Xpsaas\Tenancy\Environment;
use Xpsaas\Tenancy\Repositories;
use Xpsaas\Tenancy\Providers\Tenants as Providers;
use Xpsaas\Tenancy\Contracts\Website as WebsiteContract;
use Xpsaas\Tenancy\Contracts\Hostname as HostnameContract;
use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../assets/configs/tenancy.php',
            'tenancy'
        );

        $this->app->singleton(Contracts\Repositories\HostnameRepository::class, Repositories\HostnameRepository::class);
        $this->app->singleton(Contracts\Repositories\WebsiteRepository::class, Repositories\WebsiteRepository::class);



        $this->app->singleton(Environment::class, function ($app) {
            return new Environment($app);
        });

        $this->registerModels();
        $this->registerProviders();
    }

    protected function registerModels()
    {
        $config = $this->app['config']['tenancy.models'];

        $this->app->bind(HostnameContract::class, $config['hostname']);
        $this->app->bind(WebsiteContract::class, $config['website']);
    }

    protected function registerProviders()
    {
        $this->app->register(Providers\PasswordProvider::class);
        $this->app->register(Providers\BusProvider::class);
    }

    public function provides()
    {
        return [
            Environment::class,
            Contracts\Repositories\HostnameRepository::class,
            Contracts\Repositories\WebsiteRepository::class,
        ];
    }
}