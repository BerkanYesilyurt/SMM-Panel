<?php

namespace App\Models;

use Illuminate\Database\Eloquent\MassPrunable;
use App\Database\Model;

/**
 * App\Models\ErrorLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ErrorLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ErrorLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ErrorLog query()
 * @mixin \Eloquent
 */
class ErrorLog extends Model
{
    use MassPrunable;

    protected $table = 'error_logs';
    protected $guarded = ['id'];
    protected $casts = ['trace' => 'json'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<', now()->subDays(configValue('errorlogs_delete')));
    }
}
