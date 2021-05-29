<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Category
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $slug
 * @property string|null $banner
 * @property int $status
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $product_view
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $trendingProducts
 * @property-read int|null $trending_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'name', 'image','status','slug','is_featured','banner'
    ];
//     protected $appends = [
//         'product_view'
//    ];
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function childCategories()
    {
        return $this->hasManyThrough('App\Model\ChildCategory','App\Model\SubCategory');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function productsCount(){
        return $this->hasMany(Product::class)->count();
    }
    public function trendingProducts(){
        return $this->hasMany(Product::class)->with('brand')->orderBy('viewed','desc')->limit(6);
    }
    public function getProductViewAttribute(){
        return \intval($this->products()->sum('viewed'));
    }
    public function orders(){ 
        return $this->hasManyThrough('App\Model\OrderProduct','App\Model\Product');
    }
}

