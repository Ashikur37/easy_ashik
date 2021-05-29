<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\FlashSaleProduct
 *
 * @property int $id
 * @property int $flash_sale_id
 * @property int $product_id
 * @property string $price
 * @property int $qty
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereFlashSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleProduct whereQty($value)
 * @mixin \Eloquent
 */
class FlashSaleProduct extends Model
{
    public $timestamps = false;
    protected $fillable = ['flash_sale_id','product_id','price','qty'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
