<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $fillable=['smtp_host','smtp_port','smtp_user','smtp_pass','from_email','from_name','is_active','mail_encryption'];
}
