<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\OrderProductOption
 *
 * @property int $id
 * @property int $order_product_id
 * @property int $option_id
 * @property string|null $value
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereOrderProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProductOption whereValue($value)
 * @mixin \Eloquent
 */
class OrderProductOption extends Model
{
    //
}
