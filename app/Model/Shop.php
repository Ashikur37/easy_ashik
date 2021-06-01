<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable=["name","image","phone","location","is_active","serial"];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
