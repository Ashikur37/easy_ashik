<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialLoginSetting extends Model
{
    protected $fillable=['is_facebook','is_google','facebook_client_id','facebook_client_secret','google_client_id','google_client_secret'];
}
