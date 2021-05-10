<?php

namespace Xpsaas\Tenancy\Contracts;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
interface Hostname
{
    public function website(): BelongsTo;
}
