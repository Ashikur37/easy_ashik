<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PaymentGatewayAdditional
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $title
 * @property string|null $details
 * @property int $required
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAdditional whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentGatewayAdditional extends Model
{
    protected $fillable = [
        'payment_gateway_id','title', 'details','required',
    ];
}
