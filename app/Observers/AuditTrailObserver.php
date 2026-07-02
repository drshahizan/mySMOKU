<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AuditTrailObserver
{
    public function created(Model $model)
    {
        $this->record($model, 'created', [], $model->getAttributes());
    }

    public function updated(Model $model)
    {
        $changes = $model->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $oldValues = [];

        foreach (array_keys($changes) as $field) {
            $oldValues[$field] = $model->getOriginal($field);
        }

        $this->record($model, 'updated', $oldValues, $changes);
    }

    public function deleted(Model $model)
    {
        $this->record($model, 'deleted', $model->getOriginal(), []);
    }

    private function record(Model $model, string $event, array $oldValues, array $newValues): void
    {
        if (! Schema::hasTable('audit_logs')) {
            return;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => $event,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'changed_fields' => array_values(array_unique(array_merge(
                array_keys($oldValues),
                array_keys($newValues)
            ))),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
        ]);
    }
}
