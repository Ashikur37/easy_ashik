<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\RelatedProduct
 *
 * @property int $product_id
 * @property int $related_product_id
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedProduct whereRelatedProductId($value)
 * @mixin \Eloquent
 */
class RelatedProduct extends Model
{
    protected $fillable = [
        'option_id', 'related_product_id',
    ];
}
