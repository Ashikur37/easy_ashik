<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
