<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        $all = self::getAll();
        return $all[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }
            self::query()->updateOrCreate(
                ['key' => $key],
                ['value' => is_string($value) ? $value : json_encode($value)]
            );
            Cache::forget('app_settings');
        } catch (\Throwable $e) {
            //
        }
    }

    /** @return array<string, string> */
    public static function getAll(): array
    {
        try {
            if (! Schema::hasTable('settings')) {
                return [];
            }
            return Cache::remember('app_settings', 3600, function () {
                $items = self::query()->pluck('value', 'key');
                return $items->toArray();
            });
        } catch (\Throwable $e) {
            return [];
        }
    }
}
