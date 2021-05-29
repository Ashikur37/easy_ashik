<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductAttributeValue
 *
 * @property int $product_attribute_id
 * @property int $attribute_value_id
 * @property-read \App\Model\AttributeValue $value
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereAttributeValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereProductAttributeId($value)
 * @mixin \Eloquent
 */
class ProductAttributeValue extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_attribute_id', 'attribute_value_id',
    ];
    public function value(){
        return $this->belongsTo(AttributeValue::class,'attribute_value_id');
    }
}