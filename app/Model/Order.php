<?php

namespace App\Model;

use App\Services\LanguageService;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Order
 *
 * @property int $id
 * @property string $order_number
 * @property int|null $customer_id
 * @property string $customer_email
 * @property string|null $customer_phone
 * @property string $customer_first_name
 * @property string $customer_last_name
 * @property string $billing_first_name
 * @property string $billing_last_name
 * @property string $billing_address_1
 * @property string|null $billing_address_2
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip
 * @property string $billing_country
 * @property string $shipping_first_name
 * @property string $shipping_last_name
 * @property string $shipping_address_1
 * @property string|null $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_state
 * @property string $shipping_zip
 * @property string $shipping_country
 * @property string $sub_total
 * @property string $shipping_method
 * @property string $shipping_cost
 * @property int|null $coupon_id
 * @property string $discount
 * @property string $total
 * @property float $tax
 * @property string $payment_method
 * @property string $currency
 * @property string $currency_rate
 * @property string $locale
 * @property string $status
 * @property int $payment_status
 * @property string|null $note
 * @property string $cart
 * @property int $affiliator
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderAddtional[] $additionals
 * @property-read int|null $additionals_count
 * @property-read \App\Model\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderTrack[] $tracks
 * @property-read int|null $tracks_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAffiliator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereShippingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $fillable = [
        'customer_id','customer_email','customer_phone','customer_first_name','customer_last_name','billing_first_name','billing_last_name','billing_address_1','billing_address_2','billing_city','billing_state','billing_zip','billing_country','shipping_first_name','shipping_last_name','shipping_address_1','shipping_address_2','shipping_city','shipping_state','shipping_zip','shipping_country','sub_total','shipping_method','shipping_cost','coupon_id','discount','total','payment_method','currency','currency_rate','locale','status','note','cart','payment_status','tax','order_number','affiliator','transaction_id','cashback'
    ];
    private  $status=["Pending","Processing","OnHold","Completed","OnDelivery","Refunded","Canceled"];
    private static  $statusArray=["Pending","Processing","OnHold","Completed","OnDelivery","Refunded","Canceled"];
    public function  getStatusDropDown($class="",$id=""){
        $html="<select id='".$id."' class='".$class."'>";
        for($i=0;$i<count($this->status);$i++){
            $selected=$this->attributes["status"]==$i?'selected':'';
            $html.="<option $selected value='$i'>".$this->status[$i]."</option>";
        }
        $html.="</select>";
        return $html;
    }
    public static function  statusDropDown($class="",$id="",$route){
        $html="<select id='".$id."' class='".$class."' data-route='".$route."'>";
        for($i=0;$i<count(self::$statusArray);$i++){
           
            $html.="<option  value='$i'>".self::$statusArray[$i]."</option>";
        }
        $html.="</select>";
        return $html;
    }
    public function statusText(){
        return LanguageService::getTranslate($this->status[$this->attributes["status"]]);
    }
    public function statusClass(){
        return ["warning","info","primary","success","","danger","danger"][$this->attributes["status"]];
    }
    public function paymentStatusText(){
        return LanguageService::getTranslate(["Unpaid","Paid"][$this->attributes["payment_status"]]) ;
    }
    public function paymentStatusClass(){
        return ["status__pending","status__paid"][$this->attributes["payment_status"]];
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function tracks(){
        return $this->hasMany(OrderTrack::class);
    }
    public function products(){
        return $this->hasMany(OrderProduct::class);
    }
    public function additionals(){
        return $this->hasMany(OrderAddtional::class);
    }
    
}
