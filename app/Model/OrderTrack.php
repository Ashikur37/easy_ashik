<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\OrderTrack
 *
 * @property int $id
 * @property int $order_id
 * @property string $title
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderTrack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderTrack extends Model
{
    protected $fillable = [
        'order_id', 'title','details',
    ];
}
