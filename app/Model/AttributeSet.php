<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AttributeSet
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttributeSet extends Model
{
    protected $fillable = [
        'name',
    ];
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function attributeCount()
    {
        return $this->attributes()->count();
    }
}
