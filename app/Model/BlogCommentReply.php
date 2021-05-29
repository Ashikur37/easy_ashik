<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BlogCommentReply
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_comment_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\BlogComment $blogComment
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereBlogCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCommentReply whereUserId($value)
 * @mixin \Eloquent
 */
class BlogCommentReply extends Model
{
    protected $fillable = ['blog_comment_id','user_id','text','commenter_type'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blogComment(){
        return $this->belongsTo(BlogComment::class);
    }

}
