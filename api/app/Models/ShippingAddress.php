<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $table = 'shipping_address';
    public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id')->select('id','username');
    }
}
