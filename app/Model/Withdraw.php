<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Withdraw
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property int $status
 * @property string|null $account_name
 * @property string|null $email
 * @property string|null $method
 * @property string|null $iban
 * @property string|null $address
 * @property string|null $swift
 * @property string|null $reference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereSwift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserId($value)
 * @mixin \Eloquent
 */
class Withdraw extends Model
{
    protected $fillable=['user_id','amount','status','account_name','email','method','iban','address','swift','reference'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
