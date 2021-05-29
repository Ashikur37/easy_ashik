<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\CouponProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $coupon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CouponProduct extends Model
{
    protected $fillable = ['product_id','coupon_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
