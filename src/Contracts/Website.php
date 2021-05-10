<?php
namespace Xpsaas\Tenancy\Contracts;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property string $managed_by_database_connection
 * @property Hostname[] $hostnames
 */
interface Website
{
    public function hostnames(): HasMany;
}