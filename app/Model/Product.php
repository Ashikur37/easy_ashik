<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Cache;
/**
 * App\Model\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int|null $sub_category_id
 * @property int|null $child_category_id
 * @property string $details
 * @property int|null $brand_id
 * @property string $slug
 * @property string $image
 * @property string $price
 * @property string $price_type
 * @property string|null $special_price
 * @property string|null $special_price_start
 * @property string|null $special_price_end
 * @property string $special_price_type
 * @property string|null $selling_price
 * @property string|null $sku
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int $manage_stock
 * @property int|null $qty
 * @property int $in_stock
 * @property int $viewed
 * @property int $is_active
 * @property int $is_trending
 * @property int $is_hot
 * @property int $is_top
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttributeValue[] $attributeValues
 * @property-read int|null $attribute_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BadgeProduct[] $badges
 * @property-read int|null $badges_count
 * @property-read \App\Model\Brand|null $brand
 * @property-read \App\Model\Category $category
 * @property-read \App\Model\ChildCategory|null $childCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductColor[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductComment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $rating
 * @property-read mixed $rating_percent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Badge[] $productBadges
 * @property-read int|null $product_badges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Color[] $productColors
 * @property-read int|null $product_colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Size[] $productSizes
 * @property-read int|null $product_sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tag[] $productTags
 * @property-read int|null $product_tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductSize[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \App\Model\SubCategory|null $subCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductTag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBrandId($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereChildCategoryId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDetails($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereInStock($value)
 * @method static Builder|Product whereIsActive($value)
 * @method static Builder|Product whereIsHot($value)
 * @method static Builder|Product whereIsTop($value)
 * @method static Builder|Product whereIsTrending($value)
 * @method static Builder|Product whereManageStock($value)
 * @method static Builder|Product whereMetaDescription($value)
 * @method static Builder|Product whereMetaTitle($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product wherePriceType($value)
 * @method static Builder|Product whereQty($value)
 * @method static Builder|Product whereSellingPrice($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereSpecialPrice($value)
 * @method static Builder|Product whereSpecialPriceEnd($value)
 * @method static Builder|Product whereSpecialPriceStart($value)
 * @method static Builder|Product whereSpecialPriceType($value)
 * @method static Builder|Product whereSubCategoryId($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereViewed($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'shop_id','name','brand_id', 'slug','price','special_price','special_price_start','special_price_end','selling_price','sku','manage_stock','qty','in_stock','viewed','is_active','details','special_price_type','category_id','sub_category_id','child_category_id','meta_title','meta_description','image','price_type','is_trending','is_hot','is_top','best_deal','rating','user_id','cashback'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $appends = [
         'rating_percent'
    ];
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function productSizes()
    {
        return $this->belongsToMany('App\Model\Size','App\Model\ProductSize');
    }
    public function productColors()
    {
        return $this->belongsToMany('App\Model\Color','App\Model\ProductColor');
    }

    public function getRatingPercentAttribute()
    {
            return $this->ratingPercent();
    }
    public function ratingPercent()
    {
        return ($this->rating / 5) * 100; 
    }
    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }
    public function productTags()
    {
        return $this->belongsToMany('App\Model\Tag','App\Model\ProductTag');
    }
    public function badges()
    {
        return $this->hasMany(BadgeProduct::class);
    }
    public function productBadges()
    {
        return $this->belongsToMany('App\Model\Badge','App\Model\BadgeProduct')->where('status', '=', 1);
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function attributeValues()
    {
        return $this->hasManyThrough('App\Model\ProductAttributeValue','App\Model\ProductAttribute');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function comments()
    {
        return $this->hasMany(ProductComment::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function inStock($num=0)
    {
        if(Cache::get('flashSaleProducts')){

            if(in_array($this->attributes["id"],Cache::get('flashSaleProducts'))){
                $flashSale=Cache::get('flashSale');
                $flashSaleProduct=$flashSale->products->where('product_id',$this->attributes["id"])->first();
                if($flashSaleProduct->qty>=$num){
                    return true;
                }
            }
            else{
                if(($this->attributes['in_stock']==1&&($this->attributes['qty']>=$num||!$this->attributes['qty']))){
                    return true;
                }
                return false;
            }
        }
        else if(($this->attributes['in_stock']==1&&($this->attributes['qty']>=$num||!$this->attributes['qty']))){
           
            return true;
        }
        return false;
    }
    public function canReview(){
        return Order::where('customer_id',auth()->user()->id)->where('status',3)->whereHas('products', function (Builder $query) {
            $query->where('product_id',$this->attributes["id"]);
        })->count();
    }
    public function hadReview(){
        return Review::where('reviewer_id',auth()->user()->id)->where('product_id',$this->attributes["id"])->count(); 
    }
    public function getSpecialPrice()
    {   
        $specialPrice = $this->attributes['special_price'];
        if(Cache::get('flashSaleProducts')){
            if(in_array($this->attributes["id"],Cache::get('flashSaleProducts'))){
                $flashSale=Cache::get('flashSale');
                $flashSaleProduct=$flashSale->products->where('product_id',$this->attributes["id"])->first();
                return $flashSaleProduct->price;
            }
        }
       
        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }

        if ($specialPrice < 0) {
            $specialPrice = 0;
        }
        if($this->price_type=='discount'&&(today() >= $this->special_price_start||!$this->special_price_start)&&(today() <= $this->special_price_end||!$this->special_price_end)){

            return $specialPrice;
        }
        else{
            return $this->attributes['price'];
        }
    }
    public function getDiscount()
    {
            return floor(100-($this->price/$this->actualPrice())*100);
    }
    public function getSpecialPriceCurrency()
    {
        $specialPrice = $this->attributes['special_price'];

        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }

        if ($specialPrice < 0) {
            $specialPrice = 0;
        }
        if($this->price_type=='discount'&&(today() >= $this->special_price_start||!$this->special_price_start)&&(today() <= $this->special_price_end||!$this->special_price_end)){

            return $this->currencyPrice($specialPrice);
        }
        else{
            return $this->currencyPrice($this->attributes['price']);
        }
    }
    public static function highlight($str, $search){
        $highlightcolor = Setting::first()->theme_color;
        //theme_color
        $occurrences = substr_count(strtolower($str), strtolower($search));
        $newstring = $str;
        $match = array();
     
        for ($i=0;$i<$occurrences;$i++) {
            $match[$i] = stripos($str, $search, $i);
            $match[$i] = substr($str, $match[$i], strlen($search));
            $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
        }
     
        $newstring = str_replace('[#]', '<span class="search-highlight">', $newstring);
        $newstring = str_replace('[@]', '</span>', $newstring);
        return $newstring;
    }
    public static function currencyPrice($price) {

            $curr = Session::get('currency');
            return $curr->sign.$price;
        
    }
    public static function currencyPriceRate($price) {
            $curr = Session::get('currency');
           
            $price=$curr->rate*$price;
            return $curr->sign.$price;
        
    }
    public static function currencyPriceRateWithoutSign($price) {
        $curr = Session::get('currency');
        return $curr->rate*$price;
    }
    public function getPriceAttribute()
    {
        $curr = Session::get('currency');
        $specialPrice = $this->attributes['special_price'];
        $flashSaleProducts=[];
        if(Cache::get('flashSaleProducts')){
            $flashSaleProducts=Cache::get('flashSaleProducts');
        }
        if(in_array($this->attributes["id"],$flashSaleProducts)){
            $flashSale=Cache::get('flashSale');
            $flashSaleProduct=$flashSale->products->where('product_id',$this->attributes["id"])->first();
            return $flashSaleProduct->price*$curr->rate;
        }
        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }
        if ($specialPrice < 0) {
            $specialPrice = 0;
        }
        if($this->price_type=='discount'&&(today() >= $this->special_price_start||!$this->special_price_start)&&(today() <= $this->special_price_end||!$this->special_price_end)){
            return $specialPrice*$curr->rate;
        }
        else{
            
            return $this->attributes['price']*$curr->rate;
        }
        
    }
    public function actualPrice()
    {
        $curr = Session::get('currency');
        return $this->attributes['price']*$curr->rate;

    }
    public function orders(){ 
        return $this->hasMany(OrderProduct::class);
    }
    public function getSoldAttribute(){ 
        return $this->hasMany(OrderProduct::class)->sum('qty');
    }
    public function getSpecialPriceInRange($min,$max)
    {
   
        $curr = Session::get('currency');
        $specialPrice = $this->attributes['special_price'];

        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }

        if ($specialPrice < 0) {
            $specialPrice = 0;
        }
        if($this->price_type=='discount'&&(today() >= $this->special_price_start||!$this->special_price_start)&&(today() <= $this->special_price_end||!$this->special_price_end)){

            $price= $specialPrice*$curr->rate;
        }
        else{
            $price= $this->attributes['price']*$curr->rate;
        }
        return $price>=$min&&$price<=$max;
    }

}
