<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\NewsLetter
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsLetter extends Model
{
    //
}
