<?php


namespace Xpsaas\Tenancy\Contracts\Generator;

use Xpsaas\Tenancy\Contracts\Website;

interface GeneratesConfiguration
{
    /**
     * @param Website $website
     * @return string
     */
    public function generate(Website $website): string;
}
