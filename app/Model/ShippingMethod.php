<?php

namespace App\Model;

use Cart;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ShippingMethod
 *
 * @property int $id
 * @property string $name
 * @property string|null $price
 * @property int $is_active
 * @property float|null $free_min
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereFreeMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShippingMethod extends Model
{
    protected $fillable = ['name', 'price','free_min','is_active'];
    public function payablePrice(){
        if(Cart::total()>$this->attributes["free_min"]){
            return 0;
        }
        else{
            return $this->attributes["price"];
        }
    }
}
