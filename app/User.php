<?php

namespace App;

use App\Model\HasRoles;
use App\Model\Order;
use App\Model\Withdraw;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'email', 'password','avatar', 'provider_id', 'provider',
        'access_token','type','affiliate_link','affiliate_balance','email_verified_at','is_vendor','contact_number','gender','dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }
    public function wishListProducts()
    {
        return $this->belongsToMany('App\Model\Product','App\Model\WishList');
    }
    public function spent()
    {
        return $this->hasMany(Order::class,'customer_id')->where('payment_method','affiliate')->sum('total');
    }
    public function withdrawAmount()
    {
        return $this->hasMany(Withdraw::class)->sum('amount');
    }
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
    public function getImageUrl(){
        if($this->attributes['provider']){
            return $this->attributes['avatar'];
        } 
        else{
            return URL::to('/images/avatar.png');
        }
    }

}
