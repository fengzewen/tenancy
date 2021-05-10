<?php

namespace Xpsaas\Tenancy\Traits;

use Xpsaas\Tenancy\Contracts\Hostname;
use Xpsaas\Tenancy\Contracts\Website;

trait ConvertsEntityToWebsite
{
    /**
     * @param $entity
     * @return Website|null
     */
    protected function convertWebsiteOrHostnameToWebsite($entity)
    {
        $website = null;

        if ($entity instanceof Hostname) {
            $website = $entity->website;
        }

        if ($entity instanceof Website) {
            $website = $entity;
        }

        return $website;
    }
}
