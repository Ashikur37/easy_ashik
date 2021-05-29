<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\FlashSale
 *
 * @property int $id
 * @property string|null $title
 * @property string $image
 * @property int $is_active
 * @property string $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $flashProducts
 * @property-read int|null $flash_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\FlashSaleProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Campaign extends Model
{
    protected $fillable = [	'title','image','is_active'];
    public function products()
    {
        return $this->hasMany(CampaignProduct::class);
    }
    public function campaignProducts()
    {
        return $this->belongsToMany('App\Model\Product','App\Model\CampaignProduct');
    }
    
}
