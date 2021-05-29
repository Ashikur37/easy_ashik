<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductTag
 *
 * @property int $product_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductTag extends Model
{
    protected $fillable = ['product_id','tag_id'];
}
