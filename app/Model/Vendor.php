<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Vendor extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
