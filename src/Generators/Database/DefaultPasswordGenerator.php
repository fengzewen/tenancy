<?php


namespace Xpsaas\Tenancy\Generators\Database;

use Xpsaas\Tenancy\Contracts\Database\PasswordGenerator;
use Xpsaas\Tenancy\Contracts\Website;
use Laravel\Lumen\Application;

class DefaultPasswordGenerator implements PasswordGenerator
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param Website $website
     * @return string
     */
    public function generate(Website $website) : string
    {
        $key = $this->app['config']->get('tenancy.key');

        // Backward compatibility
        if ($key === null) {
            return md5(sprintf(
                '%s.%d',
                $this->app['config']->get('app.key'),
                $website->id
            ));
        }

        return md5(sprintf(
            '%d.%s.%s.%s',
            $website->id,
            $website->uuid,
            $website->created_at,
            $key
        ));
    }
}
