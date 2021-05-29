<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductOption
 *
 * @property int $product_id
 * @property int $option_id
 * @property-read \App\Model\Option $option
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption whereProductId($value)
 * @mixin \Eloquent
 */
class ProductOption extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'option_id',
    ];
    public function option(){
        return $this->belongsTo(Option::class);

    }

}
