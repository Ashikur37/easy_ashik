<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Attribute
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $attribute_set_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\AttributeSet $attributeSet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ChildCategory[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\AttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAttributeSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    protected $fillable = [
        'name', 'attribute_set_id','status'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_categories');
    }
    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class);
    }
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'attribute_sub_categories');
    }
    public function childCategories()
    {
        return $this->belongsToMany(ChildCategory::class, 'attribute_child_categories');
    }
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
