<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Trait Auditable
 * 
 * Trait ini harus digunakan pada Model class untuk mencatat setiap perubahan data
 * secara otomatis ke tabel audit_logs
 * 
 * Contoh penggunaan:
 * class User extends Model {
 *     use Auditable;
 * }
 * 
 * @method static void created(\Closure $callback)
 * @method static void updated(\Closure $callback)
 * @method static void deleted(\Closure $callback)
 */
trait Auditable
{
    protected static function bootAuditable(): void
    {
        // Event saat Data Baru Dibuat (CREATE)
        static::created(function ($model) {
            self::recordAudit($model, 'CREATE', null, $model->getAttributes());
        });

        // Event saat Data Diperbarui (UPDATE)
        static::updated(function ($model) {
            $oldValues = array_intersect_key($model->getOriginal(), $model->getChanges());
            $newValues = $model->getChanges();

            // Hanya catat jika benar-benar ada kolom data yang berubah
            if (!empty($newValues)) {
                self::recordAudit($model, 'UPDATE', $oldValues, $newValues);
            }
        });

        // Event saat Data Dihapus (DELETE)
        static::deleted(function ($model) {
            self::recordAudit($model, 'DELETE', $model->getOriginal(), null);
        });
    }

    protected static function recordAudit($model, string $action, ?array $oldValues = null, ?array $newValues = null): void
    {
        // Abaikan kolom timestamps dari pencatatan detail biar hemat memory DB
        if ($oldValues) {
            unset($oldValues['created_at'], $oldValues['updated_at']);
        }
        if ($newValues) {
            unset($newValues['created_at'], $newValues['updated_at']);
        }

        try {
            AuditLog::create([
                'user_id'    => Auth::id() ?? 1, // Fallback ID 1 jika belum login
                'action'     => $action,
                'model_type' => get_class($model),
                'model_id'   => $model->id ?? null,
                'old_values' => $oldValues ? json_encode($oldValues) : null,
                'new_values' => $newValues ? json_encode($newValues) : null,
                'ip_address' => request()->ip() ?? 'UNKNOWN',
                'user_agent' => request()->userAgent() ?? 'UNKNOWN',
            ]);
        } catch (\Throwable $e) {
            Log::warning('Audit log creation failed: ' . $e->getMessage());
        }
    }
}
