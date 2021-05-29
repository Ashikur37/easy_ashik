<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Coupon
 *
 * @property int $id
 * @property string $code
 * @property int $is_percent
 * @property int $active
 * @property int $all_product
 * @property int $amount
 * @property int $limit
 * @property float|null $min
 * @property float|null $max
 * @property int $times
 * @property int $used
 * @property string|null $start
 * @property string|null $end
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\CouponProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAllProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUsed($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    protected $fillable = [
        'code', 'is_percent','amount','active','limit','min','max','times','used','start','end','all_product'
    ];
    public function products()
    {
        return $this->hasMany(CouponProduct::class);
    }
    public function hasProduct($productId){
        if($this->all_product==1){
            return true;
        }
        else if(in_array($productId,$this->products->pluck('product_id')->toArray())){
            return true;
        }
        else{
            return false;
        }
        //$this->products->pluck('product_id')->toArray()
    }
    public function discountRate($price){
        if($this->is_percent==1){
            return $this->amount;
        }
        else{
            return ($this->amount/$price)*100;
        }
    }
    public function isValid()
    {
        if(((today() >= $this->start||!$this->start)&&(today() <= $this->end||!$this->end))&&($this->limit>0||$this->limit==-1)&&$this->active==1){

            return true;
        }
        else{
            return false;
        }
       
    }
}
