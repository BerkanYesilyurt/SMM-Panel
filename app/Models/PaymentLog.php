<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog query()
 * @mixin \Eloquent
 */

class PaymentLog extends Model
{
    protected $table = 'payment_logs';
    protected $guarded = ['id'];
    protected $casts = [
        'details' => 'array'
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
