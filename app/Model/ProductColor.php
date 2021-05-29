<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductColor
 *
 * @property int $product_id
 * @property int $color_id
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereProductId($value)
 * @mixin \Eloquent
 */
class ProductColor extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'color_id','price'
    ];
}
