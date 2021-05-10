<?php

namespace Xpsaas\Tenancy\Contracts\Repositories;

use Xpsaas\Tenancy\Contracts\Website;
use Illuminate\Database\Eloquent\Builder;

interface WebsiteRepository
{
    /**
     * @param string $uuid
     * @return Website|null
     */
    public function findByUuid(string $uuid);

    /**
     * @param string|int $id
     * @return Website|null
     */
    public function findById($id);
    /**
     * @param Website $website
     * @return Website
     */
    public function create(Website &$website): Website;
    /**
     * @param Website $website
     * @return Website
     */
    public function update(Website &$website): Website;
    /**
     * @param Website $website
     * @param bool $hard
     * @return Website
     */
    public function delete(Website &$website, $hard = false): Website;

    /**
     * @warn Only use for querying.
     * @return Builder
     */
    public function query(): Builder;
}
