<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $guarded = ['id'];

    /**
     * Read a single setting value, falling back to $default when the key
     * (or the table itself) is not available yet.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        try {
            return static::query()->where('key', $key)->value('value') ?? $default;
        } catch (Throwable $e) {
            return $default;
        }
    }
}
