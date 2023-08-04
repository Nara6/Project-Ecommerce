<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table= 'order';
    public function orderDetail(){
        return $this->hasMany('App\Models\OrderDetail', "order_id");
    }
}
