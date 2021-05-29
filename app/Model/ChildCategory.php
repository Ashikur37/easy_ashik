<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ChildCategory
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string|null $banner
 * @property int $status
 * @property string $slug
 * @property int $sub_category_id
 * @property int $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Model\SubCategory $subCategory
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChildCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChildCategory extends Model
{
    protected $fillable = [
        'name', 'image','status','slug','is_featured','banner','sub_category_id',
    ];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function productsCount(){
        return $this->hasMany(Product::class)->count();
    }
}
