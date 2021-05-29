<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $banner
 * @property int $status
 * @property string $slug
 * @property int $category_id
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ChildCategory[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubCategory extends Model
{
    protected $fillable = [
        'name', 'image','status','slug','is_featured','banner','category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function productsCount(){
        return $this->hasMany(Product::class)->count();
    }
}
