<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentIntegration
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentIntegration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentIntegration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentIntegration query()
 * @mixin \Eloquent
 */
class PaymentIntegration extends Model
{
    protected $table = 'payment_integrations';
    protected $guarded = ['id'];
}
