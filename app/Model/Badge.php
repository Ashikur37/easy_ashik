<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Badge
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $background
 * @property int $status
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Badge extends Model
{
    protected $fillable = ['name', 'color','background','status'];
    public function productsCount()
    {
        return $this->belongsToMany(Product::class,BadgeProduct::class)->count();
    }
}
