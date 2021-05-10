<?php

namespace Xpsaas\Tenancy\Generators\Uuid;

use Xpsaas\Tenancy\Contracts\Website\UuidGenerator;
use Xpsaas\Tenancy\Contracts\Website;
use Ramsey\Uuid\Uuid;

class ShaGenerator implements UuidGenerator
{
    /**
     * @param Website $website
     * @return string
     */
    public function generate(Website $website) : string
    {
        $uuid = Uuid::uuid4()->toString();

        if (config('tenancy.website.uuid-limit-length-to-32')) {
            return str_replace('-', null, $uuid);
        }

        return $uuid;
    }
}
