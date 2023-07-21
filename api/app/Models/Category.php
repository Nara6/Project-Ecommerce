<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'category';
    public function item(){
        return $this->hasMany('App\Models\Item','category_id');
    }
    public function product(){
        return $this->hasMany('App\Models\Product','product_id');
    }
}
