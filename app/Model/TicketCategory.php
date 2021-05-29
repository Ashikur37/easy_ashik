<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TicketCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketCategory extends Model
{
    protected $fillable = ['name'];
}
