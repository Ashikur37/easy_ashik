<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\OptionValue
 *
 * @property int $id
 * @property int $option_id
 * @property string|null $price
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionValue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OptionValue extends Model
{
    protected $fillable = [
        'option_id', 'price','price_type','position','label',
    ];
}
