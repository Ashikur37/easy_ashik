<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PaymentGateway
 *
 * @property int $id
 * @property string $title
 * @property string $details
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PaymentGatewayAdditional[] $additionals
 * @property-read int|null $additionals_count
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentGateway extends Model
{
    protected $fillable = [
        'title', 'details','is_active',
    ];  
    public function additionals()
    {
        return $this->hasMany(PaymentGatewayAdditional::class);
    }
}
