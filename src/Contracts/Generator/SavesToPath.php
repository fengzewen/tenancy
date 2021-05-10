<?php


namespace Xpsaas\Tenancy\Contracts\Generator;

use Xpsaas\Tenancy\Contracts\Website;

interface SavesToPath
{
    /**
     * @param Website $website
     * @return string
     */
    public function targetPath(Website $website): string;
}
