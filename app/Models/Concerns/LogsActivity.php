<?php

namespace App\Models\Concerns;

use App\Services\AuditLogger;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        static::created(fn (Model $model) => app(AuditLogger::class)->modelEvent('CREATE', $model));
        static::updated(fn (Model $model) => app(AuditLogger::class)->modelEvent('UPDATE', $model));
        static::deleted(fn (Model $model) => app(AuditLogger::class)->modelEvent('DELETE', $model));
    }
}
