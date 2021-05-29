<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AffiliateProduct
 *
 * @property int $id
 * @property int $product_id
 * @property string $percentage
 * @property int $status
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AffiliateProduct extends Model
{
    protected $fillable = [
        'product_id', 'percentage','status','amount'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
