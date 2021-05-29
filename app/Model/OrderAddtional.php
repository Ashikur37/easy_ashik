<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\OrderAddtional
 *
 * @property int $id
 * @property int $order_id
 * @property int $payment_gateway_additional_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\PaymentGatewayAdditional $paymentGatewayAdditional
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional wherePaymentGatewayAdditionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddtional whereValue($value)
 * @mixin \Eloquent
 */
class OrderAddtional extends Model
{
    protected $fillable=['order_id','payment_gateway_additional_id','value'];
    public function paymentGatewayAdditional(){
        return $this->belongsTo(PaymentGatewayAdditional::class);
    }
}
