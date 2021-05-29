<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BadgeProduct
 *
 * @property int $product_id
 * @property int $badge_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Badge $badge
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereBadgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BadgeProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BadgeProduct extends Model
{
    protected $fillable = [
        'product_id', 'badge_id','is_active'
    ];
    public function badge(){
        return $this->belongsTo(Badge::class);
    }
}
