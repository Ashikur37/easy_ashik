<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Slide
 *
 * @property int $id
 * @property string $image
 * @property string|null $title
 * @property string|null $body
 * @property string|null $call_to_action_url
 * @property int|null $open_in_new_window
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $color
 * @property int $direction
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCallToActionUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereOpenInNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slide extends Model
{
    protected $fillable = [
        'image','title','body','call_to_action_url','open_in_new_window','status','color','title_color','direction','button_text'
    ]; 
}
