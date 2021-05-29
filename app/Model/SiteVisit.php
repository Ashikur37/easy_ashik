<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SiteVisit
 *
 * @property int $id
 * @property string $ip
 * @property int $is_new
 * @property string $url
 * @property string $visit_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereVisitDate($value)
 * @mixin \Eloquent
 */
class SiteVisit extends Model
{
    protected $fillable=['ip','is_new','url','visit_date'];
}
