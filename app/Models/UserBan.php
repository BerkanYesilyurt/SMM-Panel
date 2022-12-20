<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserBan
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int $permanent
 * @property \Illuminate\Support\Carbon|null $until_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan wherePermanent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan whereUntilAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBan whereUserId($value)
 * @mixin \Eloquent
 */
class UserBan extends Model
{
    protected $table = 'user_bans';
    protected $guarded = ['id'];
    protected $dates = ['until_at'];
}
