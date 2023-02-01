<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $table = 'error_logs';
    protected $guarded = ['*'];
}
