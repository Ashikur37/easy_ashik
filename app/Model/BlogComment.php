<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BlogComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $text
 * @property int $commenter_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Blog $blog
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $repliers
 * @property-read int|null $repliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BlogCommentReply[] $replies
 * @property-read int|null $replies_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereCommenterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogComment whereUserId($value)
 * @mixin \Eloquent
 */
class BlogComment extends Model
{
    protected $fillable = ['blog_id','user_id','text','commenter_type'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blog(){
        return $this->belongsTo(Blog::class);
    }
    public function replies(){
        return $this->hasMany(BlogCommentReply::class);
    }
    public function repliers() {
        return $this->belongsToMany('App\User', 'App\Model\BlogCommentReply')->distinct();
      }
}
