<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Throwable;

class AuditLogger
{
    private const SENSITIVE_KEYS = [
        'password',
        'password_confirmation',
        'remember_token',
        'token',
        'server_key',
        'client_key',
        'gateway_payload',
    ];

    public function modelEvent(string $action, Model $model): void
    {
        $changes = $action === 'UPDATE' ? $model->getChanges() : $model->getAttributes();
        $keys = array_keys($changes);

        $oldValues = $action === 'UPDATE'
            ? array_intersect_key($model->getOriginal(), array_flip($keys))
            : ($action === 'DELETE' ? $model->getOriginal() : []);

        $newValues = $action === 'DELETE' ? [] : $changes;
        $module = class_basename($model);

        $this->record(
            action: $action,
            module: $module,
            description: $this->description($action, $module, $model->getKey()),
            model: $model,
            oldValues: $oldValues,
            newValues: $newValues,
        );
    }

    public function record(
        string $action,
        string $module,
        string $description,
        ?Model $model = null,
        array $oldValues = [],
        array $newValues = [],
    ): void {
        try {
            if (!Schema::hasTable('audit_logs')) {
                return;
            }

            $request = app()->bound('request') ? request() : null;

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => strtoupper($action),
                'module' => $module,
                'auditable_type' => $model ? $model::class : null,
                'auditable_id' => $model?->getKey(),
                'description' => $description,
                'old_values' => $this->sanitize($oldValues),
                'new_values' => $this->sanitize($newValues),
                'ip_address' => $request?->ip(),
                'user_agent' => $request?->userAgent(),
            ]);
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function sanitize(array $values): ?array
    {
        $clean = collect($values)
            ->except(self::SENSITIVE_KEYS)
            ->map(fn ($value) => is_object($value) ? (string) $value : $value)
            ->all();

        return $clean === [] ? null : $clean;
    }

    private function description(string $action, string $module, mixed $id): string
    {
        $verbs = [
            'CREATE' => 'menambahkan',
            'UPDATE' => 'mengubah',
            'DELETE' => 'menghapus',
        ];

        return sprintf('%s data %s #%s', $verbs[$action] ?? strtolower($action), $module, $id ?? '-');
    }
}
