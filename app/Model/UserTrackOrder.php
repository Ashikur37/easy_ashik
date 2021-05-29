<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserTrackOrder
 *
 * @property int $id
 * @property string $order_number
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTrackOrder whereUserId($value)
 * @mixin \Eloquent
 */
class UserTrackOrder extends Model
{
    protected $fillable = ['order_number','user_id'];
}
