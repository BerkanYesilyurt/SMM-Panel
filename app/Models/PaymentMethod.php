<?php

namespace App\Models;

use App\Database\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PaymentMethod
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod query()
 * @mixin \Eloquent
 */
class PaymentMethod extends Model
{
    use SoftDeletes;
    protected $table = 'payment_methods';
    protected $guarded = ['id'];
}
