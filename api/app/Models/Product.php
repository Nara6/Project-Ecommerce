<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function category(){
        return $this->belongsTo('App\Models\Category', "category_id")->select('id','name'); //one to many
    }
    public function item(){
        return $this->belongsTo('App\Models\Item', "item_id")->select('id','name');
    }
    public function color(){
        return $this->belongsTo('App\Models\Color', "color_id")->select('id','name');
    }
    public function image(){
        return $this->hasMany('App\Models\Image', "product_id");
    }
}
