<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable=['email','ip','mail_count','last_email'];
    
}
