<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketMessage
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereUserId($value)
 * @mixin \Eloquent
 * @property int $seen_by_user
 * @property int $seen_by_support
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSeenBySupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketMessage whereSeenByUser($value)
 */
class TicketMessage extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_messages';

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
