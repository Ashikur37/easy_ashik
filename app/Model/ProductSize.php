<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductSize
 *
 * @property int $product_id
 * @property int $size_id
 * @property float $price
 * @property-read \App\Model\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSize whereSizeId($value)
 * @mixin \Eloquent
 */
class ProductSize extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'size_id','price'
    ];
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
