<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;
    protected $table = 'billing_address';
    public function user() {
        return $this->belongsTo('App\Models\Users', 'user_id')->select('id','username');
    }
}
