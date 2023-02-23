<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $description
 * @property string|null $order_id
 * @property string|null $pay_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketMessage[] $ticketMessages
 * @property-read int|null $ticket_messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @mixin \Eloquent
 * @property string $message
 * @property string|null $order_request
 * @property string|null $pay_type
 * @property string|null $feature_request
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereFeatureRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOrderRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePayType($value)
 */
class Ticket extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unseenMessageByUser()
    {
        return $this->ticketMessages()->where('seen_by_user', 0)->count() > 0;
    }
    public function unseenMessageBySupport()
    {
        return $this->ticketMessages()->where('seen_by_support', 0)->count() > 0;
    }

}
