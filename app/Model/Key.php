<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\key
 *
 * @property int $id
 * @property string $term
 * @property int $hits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|key newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|key newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|key query()
 * @method static \Illuminate\Database\Eloquent\Builder|key whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|key whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class key extends Model
{
    protected $fillable = ["term","hits"];
}
