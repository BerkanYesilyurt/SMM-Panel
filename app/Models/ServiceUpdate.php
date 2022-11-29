<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceUpdate
 *
 * @property int $id
 * @property int $service_id
 * @property int $new_service_id
 * @property int $old_price
 * @property int $new_price
 * @property string $description
 * @property int $public
 * @property int $show_id_changes
 * @property int $show_price_changes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereNewPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereNewServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereShowIdChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereShowPriceChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUpdate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceUpdate extends Model
{
    use HasFactory;

    protected $table = 'service_updates';
    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
