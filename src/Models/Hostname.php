<?php


namespace Xpsaas\Tenancy\Models;

use Carbon\Carbon;
use Xpsaas\Tenancy\Abstracts\SystemModel;
use Xpsaas\Tenancy\Contracts\Hostname as HostnameContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $fqdn
 * @property string $redirect_to
 * @property bool $force_https
 * @property Carbon $under_maintenance_since
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $website_id
 * @property Website $website
 */
class Hostname extends SystemModel implements HostnameContract
{
    use SoftDeletes;

    protected $dates = ['under_maintenance_since'];

    public function website(): BelongsTo
    {
        return $this->belongsTo(config('tenancy.models.website'));
    }
}
