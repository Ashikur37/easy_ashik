<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded=[];
    public function messages(){
        return $this->hasMany(ChatMessage::class);
    }
}
