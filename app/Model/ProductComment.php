<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $repliers
 * @property-read int|null $repliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductCommentReply[] $replies
 * @property-read int|null $replies_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductComment whereUserId($value)
 * @mixin \Eloquent
 */
class ProductComment extends Model
{
    protected $fillable = ['product_id','user_id','text','commenter_type'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    } 
    public function replies(){
        return $this->hasMany(ProductCommentReply::class);
    }
    public function repliers() {
        return $this->belongsToMany('App\User', 'App\Model\ProductCommentReply')->distinct();
      }
}
