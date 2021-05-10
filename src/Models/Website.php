<?php


namespace Xpsaas\Tenancy\Models;

use Carbon\Carbon;
use Xpsaas\Tenancy\Abstracts\SystemModel;
use Xpsaas\Tenancy\Contracts\Website as WebsiteContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property string $managed_by_database_connection
 * @property Hostname[] $hostnames
 */
class Website extends SystemModel implements WebsiteContract
{
    use SoftDeletes;

    public function hostnames(): HasMany
    {
        return $this->hasMany(config('tenancy.models.hostname'));
    }
}
