<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceUpdates
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdates query()
 * @mixin \Eloquent
 */
class ServiceUpdates extends Model
{
    use HasFactory;

    protected $table = 'service_updates';
}
