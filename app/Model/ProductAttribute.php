<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property-read \App\Model\Attribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereProductId($value)
 * @mixin \Eloquent
 */
class ProductAttribute extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'attribute_id',
    ];
    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
    public function valuesArray()
    {
        return $this->hasMany(ProductAttributeValue::class)->get()->pluck('attribute_value_id');
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
