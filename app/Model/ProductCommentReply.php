<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ProductCommentReply
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_comment_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\ProductComment $productComment
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereProductCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCommentReply whereUserId($value)
 * @mixin \Eloquent
 */
class ProductCommentReply extends Model
{
    protected $fillable = ['product_comment_id','user_id','text','commenter_type'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function productComment(){
        return $this->belongsTo(ProductComment::class);
    }
}
